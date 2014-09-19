<?php

namespace Sph\Storage\Miembro;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Miembro;
use Imagen;

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
                        if (isset($miembro_model['nombre_imagen']))
                        {
                              $imagen = new Imagen($miembro_model);
                              $imagen->nombre = $miembro_model['nombre_imagen'];
                              $imagen->user_id = $miembro->user->id;
                              $imagen->alt = 'user_profile_image';
                              $miembro->imagen()->save($imagen);
                        }
                        else
                        {
                              $miembro->imagen->alt = 'user_profile_image';
                              $miembro->imagen->save();
                        }
                        
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
