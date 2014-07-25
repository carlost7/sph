<?php

namespace Sph\Storage\Pago;

interface PagoRepository
{

      public function all();

      public function find($id);

      public function create(array $pago_model);

      public function update($id, array $pago_model);

      public function delete($id);
      
      public function checar_codigo($numero);
      
      public function usar_codigo($id,$codigo_model);
      
      public function publicar_contenido($pago);
}
