<?php

namespace Sph\Storage\Administrador;

interface AdministradorRepository
{

      public function all();

      public function find($id);

      public function create(array $admin_model);

      public function update($id, array $admin_model);

      public function delete($id);
}
