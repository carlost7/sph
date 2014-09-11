<?php

namespace Sph\Storage\Estado;

interface EstadoRepository
{

      public function all();

      public function find($id);

      public function create(array $estado_model);

      public function update($id, array $estado_model);

      public function delete($id);
      
      public function getEstadoLike($word);
}
