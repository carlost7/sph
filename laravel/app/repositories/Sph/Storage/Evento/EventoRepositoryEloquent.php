<?php

namespace Sph\Storage\Evento;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Evento;
use Evento_especial;

class EventoRepositoryEloquent implements EventoRepository
{

      public function all()
      {
            return Evento::all();
      }

      public function create(array $evento_model)
      {

            $evento = new Evento($evento_model);
            $evento->inicio = new \DateTime($evento_model['inicio']);
            $evento->fin = new \DateTime($evento_model['fin']);
            $evento->client_id = $evento_model['client']->id;

            if ($evento->save())
            {
                  return $evento;
            }
            return null;
      }

      public function delete($id)
      {
            return Evento::destroy($id);
      }

      public function find($id)
      {
            return Evento::find($id);
      }

      public function update($id, array $evento_model)
      {
            $evento = Evento::find($id);

            if (isset($evento))
            {
                  $evento->fill($evento_model);
                  $evento->inicio = new \DateTime($evento_model['inicio']);
                  $evento->fin = new \DateTime($evento_model['fin']);

                  if ($evento->save())
                  {
                        if(!$evento->is_especial){
                              return $evento;
                        }
                        
                        $evento_especial = $evento->especial;

                        if (isset($evento_especial))
                        {
                              if ($evento->especial()->update($evento_model['especial']))
                              {
                                    return $evento;
                              }
                              else
                              {
                                    return null;
                              }
                        }
                        else
                        {
                              $evento_especial = new Evento_especial($evento_model['especial']);
                              if ($evento->especial()->save($evento_especial))
                              {
                                    return $evento;
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
