<?php

namespace Sph\Storage\Rank;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Rank;

class RankRepositoryEloquent implements RankRepository
{

      public function all()
      {
            return Rank::all();
      }

      public function create(array $rank_model)
      {
            $rank = new Rank();

            $rank->miembro_id = $rank_model['miembro_id'];
            $rank->rankable_type = get_class($rank_model['objeto']);
            $rank->rankable_id = $rank_model['objeto']->id;

            if ($rank->save())
            {
                  return $rank;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Rank::destroy($id);
      }

      public function find($id)
      {
            return Rank::find($id);
      }

      public function update($id, array $rank_model)
      {
            $rank = Rank::find($id);

            return $rank;
      }

}
