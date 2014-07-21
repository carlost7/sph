<?php

namespace Sph\Storage\Pago;

interface PagoRepository
{

      public function all();

      public function find($id);

      public function create(array $pago_model);

      public function update($id, array $pago_model);

      public function delete($id);
}
