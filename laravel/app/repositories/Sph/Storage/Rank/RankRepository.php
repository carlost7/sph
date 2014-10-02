<?php

namespace Sph\Storage\Rank;

interface RankRepository
{

      public function all();

      public function find($id);

      public function create(array $rank_model);

      public function update($id, array $rank_model);

      public function delete($id);      
      
}
