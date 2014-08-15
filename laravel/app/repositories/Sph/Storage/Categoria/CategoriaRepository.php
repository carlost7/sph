<?php

namespace Sph\Storage\Categoria;

interface CategoriaRepository
{

      public function all();

      public function find($id);

      public function create(array $categoria_model);

      public function update($id, array $categoria_model);

      public function delete($id);
}
