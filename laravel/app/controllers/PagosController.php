<?php

use Sph\Storage\Checkout\CheckoutRepository as Checkout;
use Sph\Storage\Pago\PagoRepository as Pago;

class PagosController extends \BaseController
{

      protected $checkout;
      protected $pago;

      public function __construct(Checkout $checkout, Pago $pago)
      {
            $this->checkout = $checkout;
            $this->pago = $pago;
      }

      /*
       * ****************************
       * Espera notificaciones de pago desde Mercado pago y la envia por correo a un programador
       * ****************************
       */

      public function recibir_notificacion_prueba()
      {
            //$id = Input::get('id');
            $id = "1407455060";            
            Log::info('PagosController@recibir_notificacion_prueba: '.$id."/n".\Carbon\Carbon::now()->toDateString());
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
                  Log::info('PagosController@recibir_notificacion_prueba: '.print_r($mensaje,true)."/n".\Carbon\Carbon::now()->toDateString());
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
      }

      public function recibir_notificacion()
      {
            $id = Input::get('id');
            if (isset($id))
            {
                  $response = $this->checkout->recibir_notificacion($id);
                  if (isset($response))
                  {
                        $external_reference = $response['collection']['external_reference'];
                        $status = $response['collection']['status'];

                        $user = $this->Pagos->actualizarStatusPagos($external_reference, $status);
                        if (isset($user))
                        {

                              switch ($status)
                              {
                                    case 'approved':
                                          $this->agregarDominio($user);
                                          break;
                                    case "pending":
                                          echo "Pago pendiente";
                                          break;
                                    case "in_process":
                                          echo "pago en proceso";
                                          break;
                                    case "rejected":
                                          echo "Pago rechazado";
                                          break;
                                    case "refunded":
                                          echo "Pago regresado";
                                          break;
                                    case "cancelled":
                                          $this->cancelarUsuario($user);
                                          break;
                                    case "in_mediation":
                                          echo "status en_mediacion";
                                          break;
                                    default :
                                          echo "status incorrecto";
                                          break;
                              }
                        }
                        else
                        {
                              Log::info('PagosController . obtenerIPNMercadoPago No se encuentra ningun usuario con el numero de orden ' . $external_reference);
                              echo "no se encontro ningun usuario";
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
