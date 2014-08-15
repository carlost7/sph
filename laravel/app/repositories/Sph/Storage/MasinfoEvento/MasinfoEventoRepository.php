<?php

namespace Sph\Storage\MasinfoEvento;

interface MasinfoEventoRepository
{

      public function all();

      public function find($id);

      public function create(array $mie_model);

      public function update($id, array $mie_model);

      public function delete($id);
}
