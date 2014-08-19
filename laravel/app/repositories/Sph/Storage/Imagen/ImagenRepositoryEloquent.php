<?php

namespace Sph\Storage\Imagen;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Imagen;

class ImagenRepositoryEloquent implements ImagenRepository
{

      public function all()
      {
            return Imagen::all();
      }

      public function create(array $imagen_model)
      {
            $imagen = new Imagen();
            $imagen->email = $imagen_model['email'];
            $imagen->password = \Hash::make($imagen_model['password']);
            if ($imagen->save())
            {

                  return $imagen;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Imagen::destroy($id);
      }

      public function find($id)
      {
            return Imagen::find($id);
      }

      public function update($id, array $imagen_model)
      {
            $imagen = Imagen::find($id);
            if (isset($imagen))
            {
                  if ($imagen->save())
                  {
                        return $imagen;
                  }
                  else
                  {
                        return null;
                  }
            }

            return null;
      }

}
