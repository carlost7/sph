<?php

namespace Sph\Storage\Codigo;

interface CodigoRepository
{

      public function all();

      public function find($id);

      public function create(array $codigo_model);

      public function update($id, array $codigo_model);

      public function delete($id);
}
