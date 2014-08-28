<?php

namespace Sph\Storage\Evento_Especial;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Evento;
use Evento_especial;
use Imagen;

class EventoEspecialRepositoryEloquent implements EventoEspecialRepository
{

      public function all()
      {
            return Evento::all();
      }

      public function create($id_evento, array $especial_model)
      {
            $especial = Evento::find($id_evento)->especial;
            if ($especial)
            {

                  if (isset($especial_model['nombre_imagen']))
                  {
                        $imagen = new Imagen($especial_model);
                        $imagen->nombre = $especial_model['nombre_imagen'];
                        $imagen->cliente_id = $especial->evento->cliente->id;
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
