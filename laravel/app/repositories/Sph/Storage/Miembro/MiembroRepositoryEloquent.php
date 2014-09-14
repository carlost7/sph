<?php

namespace Sph\Storage\Miembro;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Miembro;

class MiembroRepositoryEloquent implements MiembroRepository
{

      public function all()
      {
            return Miembro::all();
      }

      public function create(array $miembro_model)
      {
            $miembro = new Miembro($miembro_model);
            if ($miembro->save())
            {
                  $miembro->user()->save($miembro_model['user']);
                  return $miembro;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Miembro::destroy($id);
      }

      public function find($id)
      {
            return Miembro::find($id);
      }

      public function update($id, array $miembro_model)
      {
            $miembro = Miembro::find($id);
            if (isset($miembro))
            {
                  $miembro->fill($miembro_model);
                  
                  if ($miembro->save())
                  {
                        return $miembro;
                  }
                  else
                  {
                        return null;
                  }
            }

            return null;
      }
      
}
