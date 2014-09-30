<?php

namespace Sph\Storage\Evento;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Evento;
use Evento_especial;
use MasInfoEvento;
use Imagen;

class EventoRepositoryEloquent implements EventoRepository
{

      public function all()
      {
            return Evento::all();
      }

      public function create(array $evento_model)
      {

            $evento = new Evento($evento_model);
            $evento->fecha_inicio = new \DateTime($evento_model['fecha_inicio']);
            $evento->fecha_fin = new \DateTime($evento_model['fecha_fin']);
            $evento->hora_inicio = new \DateTime($evento_model['hora_inicio']);
            $evento->hora_fin = new \DateTime($evento_model['hora_fin']);
            $evento->cliente_id = $evento_model['cliente']->id;
            $evento->categoria_id = $evento_model['categoria'];
            $evento->publicacion_inicio = new \DateTime($evento_model['publicacion_inicio']);
            $evento->publicacion_fin = new \DateTime($evento_model['publicacion_fin']);
            if (isset($evento_model['subcategoria']))
            {
                  $evento->subcategoria_id = $evento_model['subcategoria'];
            }
            $evento->estado_id = $evento_model['estado'];
            if (isset($evento_model['zona']))
            {
                  $evento->zona_id = $evento_model['zona'];
            }

            if ($evento->save())
            {
                  $mas_info = new MasInfoEvento($evento_model);
                  $evento->masInfo()->save($mas_info);

                  if (isset($evento_model['nombre_imagen']))
                  {
                        $imagen = new Imagen($evento_model);
                        $imagen->nombre = $evento_model['nombre_imagen'];
                        $imagen->user_id = $evento->cliente->user->id;
                        $evento->imagen()->save($imagen);
                  }

                  $evento_especial = new Evento_especial($evento_model);
                  $evento->especial()->save($evento_especial);

                  return $evento;
            }
            return null;
      }

      public function find($id)
      {
            return Evento::find($id);
      }

      public function delete($id)
      {
            $evento = Evento::find($id);
            $evento->pago()->delete();
            $evento->aviso()->delete();
            $evento->imagen()->delete();

            if (isset($evento->especial))
            {
                  $evento->especial->imagenes()->delete();
            }

            return Evento::destroy($id);
      }

      public function update($id, array $evento_model)
      {
            $evento = Evento::find($id);

            if (isset($evento))
            {
                  $evento->fill($evento_model);
                  $evento->fecha_inicio = new \DateTime($evento_model['fecha_inicio']);
                  $evento->fecha_fin = new \DateTime($evento_model['fecha_fin']);
                  $evento->hora_inicio = new \DateTime($evento_model['hora_inicio']);
                  $evento->hora_fin = new \DateTime($evento_model['hora_fin']);
                  $evento->categoria_id = $evento_model['categoria'];
                  if (isset($evento_model['publicacion_inicio']))
                  {
                        $evento->publicacion_inicio = new \DateTime($evento_model['publicacion_inicio']);
                  }
                  if (isset($evento_model['publicacion_fin']))
                  {
                        $evento->publicacion_fin = new \DateTime($evento_model['publicacion_fin']);
                  }
                  if (isset($evento_model['subcategoria']))
                  {
                        $evento->subcategoria_id = $evento_model['subcategoria'];
                  }
                  $evento->estado_id = $evento_model['estado'];
                  if (isset($evento_model['zona']))
                  {
                        $evento->zona_id = $evento_model['zona'];
                  }
                  if (isset($evento_model['publicar']))
                  {
                        $evento->publicar = $evento_model['publicar'];
                  }
                  

                  if ($evento->save())
                  {
                        $evento->masInfo->fill($evento_model);
                        $evento->masInfo->save();

                        if (isset($evento_model['nombre_imagen']))
                        {
                              $imagen = new Imagen($evento_model);
                              $imagen->nombre = $evento_model['nombre_imagen'];
                              $imagen->user_id = $evento->cliente->user->id;
                              $evento->imagen()->save($imagen);
                        }
                        else
                        {
                              $evento->imagen->alt = $evento_model['alt'];
                              $evento->imagen->save();
                        }

                        if (count($evento->especial))
                        {

                              $evento->especial->fill($evento_model);
                              $evento->especial->save();
                        }
                        else
                        {
                              $evento_especial = new Evento_especial($evento_model);
                              $evento->especial()->save($evento_especial);
                        }

                        return $evento;
                  }
            }

            return null;
      }

      public function agregar_pago($evento_model, $pago_model)
      {

            if ($evento_model->pago()->save($pago_model))
            {
                  return $evento_model;
            }
            else
            {
                  return null;
            }
      }

}
