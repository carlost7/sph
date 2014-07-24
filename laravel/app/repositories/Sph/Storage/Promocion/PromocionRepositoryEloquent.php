<?php

namespace Sph\Storage\Promocion;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Promocion;
use Promocion_especial;

class PromocionRepositoryEloquent implements PromocionRepository
{

      public function all()
      {
            return Promocion::all();
      }

      public function create(array $promocion_model)
      {

            $promocion = new Promocion($promocion_model);
            $promocion->inicio = new \DateTime($promocion_model['inicio']);
            $promocion->fin = new \DateTime($promocion_model['fin']);
            $promocion->client_id = $promocion_model['client']->id;

            if ($promocion->save())
            {
                  return $promocion;
            }
            return null;
      }

      public function delete($id)
      {
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
                  $promocion->inicio = new \DateTime($promocion_model['inicio']);
                  $promocion->fin = new \DateTime($promocion_model['fin']);

                  if ($promocion->save())
                  {
                        if(!$promocion->is_especial){
                              return $promocion;
                        }
                        
                        $promocion_especial = $promocion->especial;

                        if (isset($promocion_especial))
                        {
                              if ($promocion->especial()->update($promocion_model['especial']))
                              {
                                    return $promocion;
                              }
                              else
                              {
                                    return null;
                              }
                        }
                        else
                        {
                              $promocion_especial = new Promocion_especial($promocion_model['especial']);
                              if ($promocion->especial()->save($promocion_especial))
                              {
                                    return $promocion;
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

}
