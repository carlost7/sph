<?php

namespace Sph\Storage\MasinfoNegocio;

interface MasinfoNegocioRepository
{

      public function all();

      public function find($id);

      public function create(array $min_model);

      public function update($id, array $min_model);

      public function delete($id);
}
