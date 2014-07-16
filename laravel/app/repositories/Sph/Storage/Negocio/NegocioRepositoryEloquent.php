<?php

namespace Sph\Storage\Negocio;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Negocio;

class NegocioRepositoryEloquent implements NegocioRepository
{

      public function all()
      {
            return Negocio::all();
      }

      public function create(array $negocio_model)
      {

            $negocio = new Negocio($negocio_model);
            $negocio->client_id = $negocio_model['client']->id;
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
                        return $negocio;
                  }
                  else
                  {
                        return null;
                  }
            }

            return null;
      }

}
