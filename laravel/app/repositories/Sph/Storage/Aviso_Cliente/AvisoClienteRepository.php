<?php

namespace Sph\Storage\Aviso_cliente;

interface AvisoClienteRepository
{

      public function all();

      public function find($id);

      public function create(array $aviso_model);

      public function update($id, array $aviso_model);

      public function delete($id);
      
}
