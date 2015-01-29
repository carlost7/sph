<?php

use Sph\Storage\Checkout\CheckoutRepository as Checkout;

class PagosController extends \BaseController {

      protected $checkout;

      public function __construct(Checkout $checkout)
      {
            parent::__construct();
            $this->checkout = $checkout;
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
            $ids   = '';
            if (Input::get('id'))
            {
                  $pago = Pago::find(Input::get('id'));
                  $item = array(
                      "title"       => $pago->nombre,
                      "description" => $pago->descripcion,
                      "quantity"    => 1,
                      "currency_id" => "MEX",
                      "unit_price"  => doubleval($pago->monto)
                  );
                  $ids  = $pago->id;
                  array_push($items, $item);
            }
            else
            {
                  $pagos = Auth::user()->userable->pagos->filter(function($pago) {
                        return $pago->pagado == false;
                  });

                  foreach ($pagos as $pago) {

                        $item = array(
                            "title"       => $pago->nombre,
                            "description" => $pago->descripcion,
                            "quantity"    => 1,
                            "currency_id" => "MEX",
                            "unit_price"  => doubleval($pago->monto)
                        );
                        $ids  = $ids . $pago->id . "-";
                        array_push($items, $item);
                  }
            }

            if (Config::get('params.prueba_pago'))
            {
                  $referer = Url::route('obtener_pago_prueba');
            }
            else
            {
                  $referer = Request::header('referer');
            }

            $preference_data = array(
                "items"              => $items,
                "payer"              => array(
                    "name"  => Auth::user()->userable->nombre,
                    "email" => Auth::user()->email,
                ),
                "back_urls"          => array(
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

      public function obtener_pago_prueba()
      {
            $exref  = Input::get('external_reference');
            $status = 'approved';
            return View::make('pagos.index')->with(array('exref' => $exref, 'status' => $status));
      }

      /*
       * ****************************
       * Espera notificaciones de pago desde Mercado pago y la envia por correo a un programador
       * ****************************
       */

      public function recibir_notificacion_prueba()
      {
            Log::info('PagosController.recibir_notificacion_prueba entrada de datos');

            if (Request::isMethod('POST'))
            {
                  //Recibimos el status por correo y lo ponemos en la url para que crear el pago
                  $exref  = Input::get('exref');
                  $status = Input::get('status');

                  $response = array("external_reference" => $exref, "status" => $status);
                  if (isset($response))
                  {

                        $external_reference = $response['external_reference'];
                        $status             = $response['status'];

                        $ids = explode("-", rtrim($external_reference, "-"));

                        foreach ($ids as $id) {
                              $pago = Pago::find($id);
                              if ($status == "approved")
                              {
                                    $pago->pagado = true;
                                    $pago->status = $status;
                                    $pago->metodo = "Mercado Pago";
                              }
                              else
                              {
                                    $pago->status = $status;
                              }
                              $pago->update();
                        }
                        $email  = $pago->cliente->user->email;
                        $nombre = $pago->cliente->nombre;

                        switch ($status) {
                              case 'approved':
                                    Mail::queue('emails.publicacion_contenido_pago', array(), function($message) use ($email, $nombre) {
                                          $message->to($email, $nombre)->subject('Publicación de contenido en Sphellar');
                                    });
                                    echo "cambios realizados";
                                    break;
                              case "cenceled":
                                    Mail::queue('emails.pago_cancelado', array(), function($message) use ($email, $nombre) {
                                          $message->to($email, $nombre)->subject('Pago cancelado');
                                    });
                                    break;
                              default:
                                    
                                    echo "status diferente a aprobado";
                                    break;
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
            Log::info('PagosController.recibir_notificacion entrada de datos');


            if (Config::get('params.prueba_pago'))
            {
                  $id = Input::get('id');
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
                  Mail::queue('emails.notificacion_pago_prueba', $data, function($message) {
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

                              $external_reference = $response['collection']['external_reference'];
                              $status             = $response['collection']['status'];

                              $ids = explode("-", rtrim($external_reference, "-"));

                              foreach ($ids as $id) {
                                    $pago = Pago::find($id);
                                    if ($status == "approved")
                                    {
                                          $pago->pagado = true;
                                          $pago->status = $status;
                                          $pago->metodo = "Mercado Pago";
                                    }
                                    else
                                    {
                                          $pago->status = $status;
                                    }
                                    $pago->update();
                              }

                              switch ($status) {
                                    case 'approved':
                                          echo "cambios realizados";
                                          break;
                                    default:
                                          echo "status diferente a aprobado";
                                          break;
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
