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
      public function generar_preferencia(array $data_preference){
            $mercado_pago = new MercadoPagoFunciones();
            
            $preference = $mercado_pago->create_preference($data_preference);
            if(isset($preference)){
                  return $preference;
            }else{
                  return null;
            }
            
            
      }
}
