<?php

namespace Sph\Storage\Evento_Especial;

interface EventoEspecialRepository
{

      public function all();

      public function find($id);

      public function create(array $evento_model);

      public function update($id, array $evento_model);

      public function delete($id);

      public function agregar_pago($evento_model, $pago_model);

      public function activar($id);
}
