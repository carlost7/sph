<?php

namespace Sph\Storage\Negocio_Especial;

interface NegocioEspecialRepository
{

      public function all();

      public function find($id);

      public function create($id_negocio, array $negocio_model);

      public function update($id, array $negocio_model);

      public function delete($id);
      
}
