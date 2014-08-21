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
            $negocio->cliente_id = $negocio_model['client']->id;
            $negocio->categoria_id = $negocio_model['categoria'];
            $negocio->subcategoria_id = $negocio_model['subcategoria'];
            $negocio->estado_id = $negocio_model['estado'];
            $negocio->zona_id = $negocio_model['zona'];
            if ($negocio->save())
            {                  
                  
                  $horario = new HorarioNegocio($negocio_model);                  
                  $negocio->horario()->save($horario);
                  
                  $mas_info = new MasInfoNegocio($negocio_model);
                  $negocio->mas_info()->save($mas_info);
                  
                  $imagen = new Imagen($negocio_model);
                  $imagen->nombre = $negocio_model['nombre_imagen'];
                  $imagen->cliente_id = $negocio->client->id;
                  $negocio->imagenes()->save($imagen);
                  return $negocio;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
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
                  if ($negocio->save())
                  {
                        if (!$negocio->is_especial)
                        {
                              return $negocio;
                        }

                        $negocio_especial = $negocio->especial;

                        if (isset($negocio_especial))
                        {
                              if ($negocio->especial()->update($negocio_model['especial']))
                              {
                                    return $negocio;
                              }
                              else
                              {
                                    return null;
                              }
                        }
                        else
                        {
                              $negocio_especial = new Negocio_especial($negocio_model['especial']);
                              if ($negocio->especial()->save($negocio_especial))
                              {
                                    return $negocio;
                              }
                              else
                              {
                                    return null;
                              }
                        }
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
