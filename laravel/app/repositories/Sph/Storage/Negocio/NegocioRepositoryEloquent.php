<?php

namespace Sph\Storage\Negocio;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Negocio;
use HorarioNegocio;
use MasInfoNegocio;
use Negocio_especial;
use Imagen;

class NegocioRepositoryEloquent implements NegocioRepository
{

      public function all()
      {
            return Negocio::all();
      }

      public function create(array $negocio_model)
      {
            $negocio = new Negocio($negocio_model);
            $negocio->cliente_id = $negocio_model['cliente']->id;
            $negocio->categoria_id = $negocio_model['categoria'];
            if (isset($negocio_model['subcategoria']))
            {
                  $negocio->subcategoria_id = $negocio_model['subcategoria'];                  
            }
            $negocio->estado_id = $negocio_model['estado'];
            if (isset($negocio_model['zona']))
            {
                  $negocio->zona_id = $negocio_model['zona'];
            }
            
            if ($negocio->save())
            {

                  $horario = new HorarioNegocio($negocio_model);
                  $negocio->horario()->save($horario);

                  $mas_info = new MasInfoNegocio($negocio_model);
                  $negocio->masInfo()->save($mas_info);

                  $negocio_especial = new Negocio_especial($negocio_model);
                  $negocio->especial()->save($negocio_especial);

                  if (isset($negocio_model['nombre_imagen']))
                  {
                        $imagen = new Imagen($negocio_model);
                        $imagen->nombre = $negocio_model['nombre_imagen'];
                        $imagen->user_id = $negocio->cliente->user->id;
                        $negocio->imagen()->save($imagen);
                  }
                  return $negocio;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {

            $negocio = Negocio::find($id);
            $negocio->pago()->delete();
            $negocio->aviso()->delete();
            $negocio->imagen()->delete();

            if (isset($negocio->especial))
            {
                  $negocio->especial->imagenes()->delete();
            }

            return Negocio::destroy($id);
      }

      public function find($id)
      {
            return Negocio::find($id);
      }

      public function update($id, array $negocio_model)
      {
            $negocio = Negocio::find($id);
            if (isset($negocio))
            {
                  $negocio->fill($negocio_model);
                  $negocio->categoria_id = $negocio_model['categoria'];
                  $negocio->subcategoria_id = $negocio_model['subcategoria'];
                  $negocio->estado_id = $negocio_model['estado'];
                  $negocio->zona_id = $negocio_model['zona'];

                  if ($negocio->save())
                  {

                        $negocio->horario->fill($negocio_model);
                        $negocio->horario->save();
                        $negocio->masInfo->fill($negocio_model);
                        $negocio->masInfo->save();

                        if (isset($negocio_model['nombre_imagen']))
                        {
                              $imagen = new Imagen($negocio_model);
                              $imagen->nombre = $negocio_model['nombre_imagen'];
                              $imagen->user_id = $negocio->cliente->user->id;
                              $negocio->imagen()->save($imagen);
                        }
                        else
                        {
                              $negocio->imagen->alt = $negocio_model['alt'];
                              $negocio->imagen->save();
                        }


                        if (count($negocio->especial))
                        {
                              $negocio->especial->fill($negocio_model);
                              $negocio->especial->save();
                        }
                        else
                        {
                              $negocio_especial = new Negocio_especial($negocio_model);
                              $negocio->especial()->save($negocio_especial);
                        }


                        return $negocio;
                  }
                  else
                  {
                        return null;
                  }
            }

            return null;
      }

      public function agregar_pago($negocio_model, $pago_model)
      {

            if ($negocio_model->pago()->save($pago_model))
            {
                  return $negocio_model;
            }
            else
            {
                  return null;
            }
      }

      public function activar($id)
      {
            $negocio = Negocio::find($id);
            $negocio->publicar = true;
            $negocio->is_activo = true;
            $negocio->fecha_nueva_activacion = \Carbon\Carbon::now()->addMonth();
            if ($negocio->save())
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

}
