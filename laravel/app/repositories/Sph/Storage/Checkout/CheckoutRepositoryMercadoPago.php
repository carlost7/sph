<?php

namespace Sph\Storage\Checkout;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use MercadoPagoFunciones;

class CheckoutRepositoryMercadoPago implements CheckoutRepository
{
      /*
       * ******************************
       * Genera una preferencia de pago para obtener el link de mercado pago
       * ******************************
       */
      public function generar_preferencia(array $data_preference){
            $mercado_pago = new MercadoPagoFunciones();
            
            $preference = $mercado_pago->create_preference($data_preference);
            if(isset($preference)){
                  return $preference;
            }else{
                  return null;
            }
      }
      
      /*
       * *********************************************
       * Recibe la notificacion de mercado pago
       * *********************************************
       */
      public function recibir_notificacion($id)
      {
            $mercado_pago = new MercadoPagoFunciones();
            $resultado = $mercado_pago->recibir_notificacion($id);
            if (isset($resultado))
            {
                  return $resultado;
            }
            else
            {
                  return null;
            }
      }
      
}
