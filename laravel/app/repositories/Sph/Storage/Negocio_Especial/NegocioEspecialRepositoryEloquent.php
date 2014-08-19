<?php

namespace Sph\Storage\Negocio_Especial;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Negocio;
use Negocio_especial;

class NegocioEspecialRepositoryEloquent implements NegocioEspecialRepository
{

      public function all()
      {
            return Negocio::all();
      }

      public function create(array $negocio_model)
      {
            $negocio = new Negocio($negocio_model);
            $negocio->cliente_id = $negocio_model['client']->id;
            if ($negocio->save())
            {
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

}
