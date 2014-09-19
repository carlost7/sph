<?php

namespace Sph\Storage\Negocio_Especial;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Negocio;
use Negocio_especial;
use Imagen;

class NegocioEspecialRepositoryEloquent implements NegocioEspecialRepository
{

      public function all()
      {
            return Negocio::all();
      }

      public function create($id_negocio, array $especial_model)
      {
            $especial = Negocio::find($id_negocio)->especial;
            if ($especial)
            {
                  if (isset($especial_model['nombre_imagen']))
                  {
                        $imagen = new Imagen($especial_model);
                        $imagen->nombre = $especial_model['nombre_imagen'];
                        $imagen->user_id = $especial->negocio->cliente->user->id;
                        $especial->imagenes()->save($imagen);
                  }
                  return $especial;
            }
            return null;
      }

      public function delete($id)
      {
            return Imagen::destroy($id);
      }

      public function find($id)
      {
            return Imagen::find($id);
      }

      public function update($id, array $especial_model)
      {
            $imagen = Imagen::find($id);

            if (isset($imagen))
            {
                  {
                        $imagen->alt = $especial_model['alt'];
                        $imagen->save();
                  }
                  
                  return $imagen;
            }
            return null;
      }


}
