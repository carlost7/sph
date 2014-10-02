<?php

namespace Sph\Storage\Miembro;

interface MiembroRepository
{

      public function all();

      public function find($id);

      public function create(array $zona_model);

      public function update($id, array $zona_model);

      public function delete($id);      
      
}
