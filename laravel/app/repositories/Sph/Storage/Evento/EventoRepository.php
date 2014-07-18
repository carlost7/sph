<?php

namespace Sph\Storage\Evento;

interface EventoRepository
{

      public function all();

      public function find($id);

      public function create(array $evento_model);

      public function update($id, array $evento_model);

      public function delete($id);
}
