<?php

namespace Sph\Storage\Promocion;

interface PromocionRepository
{

      public function all();

      public function find($id);

      public function create(array $evento_model);

      public function update($id, array $evento_model);

      public function delete($id);
}
