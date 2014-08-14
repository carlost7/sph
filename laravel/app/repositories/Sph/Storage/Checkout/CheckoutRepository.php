<?php

namespace Sph\Storage\Checkout;

interface CheckoutRepository
{

      //Regresa la preferencia de pago generada por MP
      public function generar_preferencia(array $data_preference);

      //Obtiene la notificacion de mercado pago
      public function recibir_notificacion($id);
}
