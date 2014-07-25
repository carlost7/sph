<?php

namespace Sph\Storage\Negocio;

interface NegocioRepository
{

      public function all();

      public function find($id);

      public function create(array $negocio_model);

      public function update($id, array $negocio_model);

      public function delete($id);
      
      public function agregar_pago($negocio_model,$pago_model);
      
      public function activar($id);
}
