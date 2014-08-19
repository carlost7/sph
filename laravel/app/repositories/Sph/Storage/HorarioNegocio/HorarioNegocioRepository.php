<?php

namespace Sph\Storage\HorarioNegocio;

interface HorarioNegocioRepository
{

      public function all();

      public function find($id);

      public function create(array $user_model);

      public function update($id, array $user_model);

      public function delete($id);
}
