<?php

namespace Sph\Storage\Subcategoria;

interface UserRepository
{

      public function all();

      public function find($id);

      public function create(array $subcat_model);

      public function update($id, array $subcat_model);

      public function delete($id);
}
