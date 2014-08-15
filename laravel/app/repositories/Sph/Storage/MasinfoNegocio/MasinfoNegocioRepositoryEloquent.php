<?php

namespace Sph\Storage\MasinfoNegocio;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use MasinfoNegocio;

class MasinfoNegocioRepositoryEloquent implements MasinfoNegocioRepository
{

      public function all()
      {
            return MasinfoNegocio::all();
      }

      public function create(array $min_model)
      {
            $min = new MasinfoNegocio($min_model);            
            if ($min->save())
            {

                  return $min;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return MasinfoNegocio::destroy($id);
      }

      public function find($id)
      {
            return MasinfoNegocio::find($id);
      }

      public function update($id, array $min_model)
      {
            $min = MasinfoNegocio::find($id);
            if (isset($min))
            {
                  $mie->fill($min_model);
                         
                  if ($min->save())
                  {
                        return $min;
                  }                  
            }

            return null;
      }

}
