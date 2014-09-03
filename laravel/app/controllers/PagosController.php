<?php

use Illuminate\Events\Dispatcher;
use Sph\Storage\Checkout\CheckoutRepository as Checkout;
use Sph\Storage\Pago\PagoRepository as Pago;

class PagosController extends \BaseController
{

      protected $checkout;
      protected $pago;
      protected $events;

      public function __construct(Checkout $checkout, Pago $pago, Dispatcher $events)
      {
            $this->checkout = $checkout;
            $this->pago = $pago;
            $this->events = $events;
      }

      /*
       * ***********************************
       * Obtiene todos los pagos que no se han realizado del cliente 
       * y los envia a mercado pago
       * 
       * si se envia un id entonces unicamente de ese contenido se genera el pago
       * ***********************************
       */

      public function generar_link_pago()
      {

            $items = array();
            $ids = '';
            if (Input::get('id'))
            {
                  $pago = $this->pago->find(Input::get('id'));
                  $item = array(
                      "title" => $pago->nombre,
                      "description" => $pago->descripcion,
                      "quantity" => 1,
                      "currency_id" => "MEX",
                      "unit_price" => doubleval($pago->monto)
                  );
                  $ids = $pago->id;
                  array_push($items, $item);
            }
            else
            {
                  $pagos = Auth::user()->userable->pagos->filter(function($pago)
                  {
                        return $pago->pagado == false;
                  });

                  foreach ($pagos as $pago)
                  {

                        $item = array(
                            "title" => $pago->nombre,
                            "description" => $pago->descripcion,
                            "quantity" => 1,
                            "currency_id" => "MEX",
                            "unit_price" => doubleval($pago->monto)
                        );
                        $ids = $ids . $pago->id . "-";
                        array_push($items, $item);
                  }
            }

            $referer = Request::header('referer');

            $preference_data = array(
                "items" => $items,
                "payer" => array(
                    "name" => Auth::user()->userable->nombre,
                    "email" => Auth::user()->email,
                ),
                "back_urls" => array(
                    "success" => $referer,
                    "failure" => $referer,
                    "pending" => $referer,
                ),
                "external_reference" => $ids,
            );

            $preference = $this->checkout->generar_preferencia($preference_data);
            if (isset($preference))
            {

                  $link = $preference['response'][Config::get('payment.init_point')];
                  return Redirect::away($link);
            }
            else
            {
                  Session::flash('error', 'Ocurrio un error al tratar de generar el pago.');
                  return Redirect::back();
            }
      }

      /*
       * ****************************
       * Espera notificaciones de pago desde Mercado pago y la envia por correo a un programador
       * ****************************
       */

      public function recibir_notificacion_prueba()
      {

            if (Request::isMethod('POST'))
            {
                  //Recibimos el status por correo y lo ponemos en la url para que crear el pago
                  $exref = Input::get('exref');
                  $status = Input::get('status');

                  $response = array("external_reference" => $exref, "status" => $status);
                  if (isset($response))
                  {

                        $external_reference = $response['external_reference'];
                        $status = $response['status'];

                        $ids = explode("-", $external_reference);

                        if ($this->pago->update_status($ids, $status))
                        {
                              switch ($status)
                              {
                                    case 'approved':
                                          $this->events->fire('pago_aprobado', array($ids));
                                          echo "cambios realizados";
                                          break;
                                    default:
                                          $this->events->fire('pago_cancelado', array($ids));
                                          echo "status diferente a aprobado";
                                          break;
                              }
                        }
                        else
                        {
                              echo "no existe el id del pago";
                        }
                  }
                  else
                  {
                        Log::error('PagosController.obtenerIPNMercadoPago No se recibio informacion de pago ID:' . $id);
                        echo "no recibido";
                  }
            }else{
                  
                  return View::make('pagos.index');
            }
      }

      /*
       * **********************************
       * Recibe notificaciones desde mercado pago
       * Realiza el cambio de status y activa los servicios
       * **********************************
       */

      public function recibir_notificacion()
      {

            if (Config::get('params.prueba_pago'))
            {
                  $id = Input::get('id');
                  Log::info('PagosController@recibir_notificacion_prueba: ' . $id . "/n" . \Carbon\Carbon::now()->toDateString());
                  if (isset($id))
                  {
                        $response = $this->checkout->recibir_notificacion($id);
                        if (isset($response))
                        {
                              $mensaje = $response;
                        }
                        else
                        {
                              $mensaje = "no se recibio notificacion";
                        }
                        Log::info('PagosController@recibir_notificacion_prueba: ' . print_r($mensaje, true) . "/n" . \Carbon\Carbon::now()->toDateString());
                  }
                  else
                  {
                        $mensaje = "no hubo id";
                  }


                  $data = array(
                      'mensaje' => $mensaje,
                  );
                  Mail::queue('emails.notificacion_pago_prueba', $data, function($message)
                  {
                        $message->to('carlos.juarez@t7marketing.com', 'Carlos Juarez')->subject('Notificación de mercado pago');
                  });
                  echo "Mensaje enviado";
            }
            else
            {
                  $id = Input::get('id');
                  if (isset($id))
                  {
                        $response = $this->checkout->recibir_notificacion($id);
                        if (isset($response))
                        {

                              $external_reference = $response['external_reference'];
                              $status = $response['status'];

                              $ids = explode("-", $external_reference);

                              if ($this->pago->update_status($ids, $status))
                              {
                                    switch ($status)
                                    {
                                          case 'approved':
                                                $this->events->fire('pago_aprobado', array($ids));
                                                echo "cambios realizados";
                                                break;
                                          default:
                                                $this->events->fire('pago_cancelado', array($ids));
                                                echo "status diferente a aprobado";
                                                break;
                                    }
                              }
                              else
                              {
                                    
                              }
                        }
                        else
                        {
                              Log::error('PagosController.obtenerIPNMercadoPago No se recibio informacion de pago ID:' . $id);
                              echo "no recibido";
                        }
                  }
                  else
                  {
                        echo "no recibi nada";
                  }
            }
      }

}
