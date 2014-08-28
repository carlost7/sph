<?php

namespace Sph\Storage\Evento_Especial;

interface EventoEspecialRepository
{

      public function all();

      public function find($id);

      public function create($id_evento,array $evento_model);

      public function update($id, array $evento_model);

      public function delete($id);
      
}
