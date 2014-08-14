<?php

namespace Sph\Storage\Bitacora_cliente;

interface BitacoraClienteRepository
{

      public function all();

      public function find($id);

      public function create(array $bitacora_model);

      public function update($id, array $bitacora_model);

      public function delete($id);
}
