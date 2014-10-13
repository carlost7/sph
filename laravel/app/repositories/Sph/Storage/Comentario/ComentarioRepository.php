<?php

namespace Sph\Storage\Comentario;

interface ComentarioRepository
{

      public function all();

      public function find($id);

      public function create(array $comentario_model);

      public function update($id, array $comentario_model);

      public function delete($id);      
      
}
