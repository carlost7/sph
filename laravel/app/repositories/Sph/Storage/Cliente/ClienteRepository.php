<?php

namespace Sph\Storage\Cliente;

interface ClienteRepository
{

      public function all();

      public function find($id);

      public function create(array $cliente_model);

      public function update($id, array $cliente_model);

      public function delete($id);
}
