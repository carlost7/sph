<?php

namespace Sph\Storage\Imagen;

interface ImagenRepository
{

      public function all();

      public function find($id);

      public function create(array $imagen_model);

      public function update($id, array $imagen_model);

      public function delete($id);
}
