<?php

namespace Sph\Storage\Subcategoria;

interface SubcategoriaRepository
{

      public function all();

      public function find($id);

      public function create(array $subcat_model);

      public function update($id, array $subcat_model);

      public function delete($id);
      
      public function getSubcatByCategoria($categoria_id);
}
