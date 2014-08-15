<?php

namespace Sph\Storage\MasinfoEvento;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use MasinfoEvento;

class MasinfoEventoRepositoryEloquent implements MasinfoEventoRepository
{

      public function all()
      {
            return MasinfoEvento::all();
      }

      public function create(array $mie_model)
      {
            $mie = new MasinfoEvento($mie_model);            
            if ($mie->save())
            {

                  return $mie;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return MasinfoEvento::destroy($id);
      }

      public function find($id)
      {
            return MasinfoEvento::find($id);
      }

      public function update($id, array $mie_model)
      {
            $mie = MasinfoEvento::find($id);
            if (isset($mie))
            {
                  $mie->fill($mie_model);

                  if ($mie->save())
                  {
                        return $mie;
                  }
                  
            }

            return null;
      }

}
