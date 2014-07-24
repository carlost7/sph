<?php

namespace Sph\Storage\Marketing;

interface MarketingRepository
{

      public function all();

      public function find($id);

      public function create(array $marketing_model);

      public function update($id, array $marketing_model);

      public function delete($id);
}
