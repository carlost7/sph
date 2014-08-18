<?php

namespace Sph\Storage\HorarioNegocio;

/**
 * Description of HorarioNegocioRepositoryEloquent
 *
 * @author carlos
 */
use HorarioNegocio;

class HorarioNegocioRepositoryEloquent implements HorarioNegocioRepository
{

      public function all()
      {
            return HorarioNegocio::all();
      }

      public function create(array $user_model)
      {
            $horarionegocio = new HorarioNegocio();            
            if ($horarionegocio->save())
            {

                  return $horarionegocio;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return HorarioNegocio::destroy($id);
      }

      public function find($id)
      {
            return HorarioNegocio::find($id);
      }

      public function update($id, array $user_model)
      {
            $horarionegocio = HorarioNegocio::find($id);
            if (isset($horarionegocio))
            {
                  if ($horarionegocio->save())
                  {
                        return $horarionegocio;
                  }                  
            }

            return null;
      }

}
