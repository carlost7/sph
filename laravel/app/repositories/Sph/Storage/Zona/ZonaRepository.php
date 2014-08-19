<?php

namespace Sph\Storage\Zona;

interface ZonaRepository
{

      public function all();

      public function find($id);

      public function create(array $zona_model);

      public function update($id, array $zona_model);

      public function delete($id);
      
      public function getZonaByEstado($estado_id);
}
