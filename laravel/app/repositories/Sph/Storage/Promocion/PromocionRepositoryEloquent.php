<?php

namespace Sph\Storage\Promocion;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Promocion;
use Imagen;

class PromocionRepositoryEloquent implements PromocionRepository
{

      public function all()
      {
            return Promocion::all();
      }

      public function create(array $promocion_model)
      {

            $promocion = new Promocion($promocion_model);
            $promocion->vigencia_inicio = new \DateTime($promocion_model['vigencia_inicio']);
            $promocion->vigencia_fin = new \DateTime($promocion_model['vigencia_fin']);
            $promocion->negocio_id = $promocion_model['negocio'];
            if ($promocion->save())
            {
                  if (isset($promocion_model['nombre_imagen']))
                  {
                        $imagen = new Imagen($promocion_model);
                        $imagen->nombre = $promocion_model['nombre_imagen'];
                        $imagen->cliente_id = $promocion->negocio->cliente->id;
                        $promocion->imagen()->save($imagen);
                  }

                  return $promocion;
            }
            return null;
      }

      public function delete($id)
      {
            $promocion = Promocion::find($id);
            $promocion->pago()->delete();
            $promocion->aviso()->delete();
            $promocion->imagen()->delete();
            return Promocion::destroy($id);            
      }

      public function find($id)
      {
            return Promocion::find($id);
      }

      public function update($id, array $promocion_model)
      {
            $promocion = Promocion::find($id);

            if (isset($promocion))
            {
                  $promocion->fill($promocion_model);
                  $promocion->vigencia_inicio = new \DateTime($promocion_model['vigencia_inicio']);
                  $promocion->vigencia_fin = new \DateTime($promocion_model['vigencia_fin']);

                  if ($promocion->save())
                  {

                        if (isset($promocion_model['nombre_imagen']))
                        {
                              $imagen = new Imagen($promocion_model);
                              $imagen->nombre = $promocion_model['nombre_imagen'];
                              $imagen->cliente_id = $promocion->negocio->cliente->id;
                              $promocion->imagen()->save($imagen);
                        }
                        else
                        {
                              $promocion->imagen->alt = $promocion_model['alt'];
                              $promocion->imagen->save();
                        }
                        return $promocion;
                  }
                  else
                  {
                        return null;
                  }
            }
            return null;
      }

      public function agregar_pago($promocion_model, $pago_model)
      {

            if ($promocion_model->pago()->save($pago_model))
            {
                  return $promocion_model;
            }
            else
            {
                  return null;
            }
      }

      public function activar($id)
      {
            $promocion = Promocion::find($id);
            $promocion->publicar = true;
            $promocion->is_activo = true;
            $promocion->fecha_nueva_activacion = \Carbon\Carbon::now()->addMonth();
            if ($promocion->save())
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

}
