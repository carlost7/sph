<?php

namespace Sph\Storage\Bitacora_cliente;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Bitacora_cliente;

class BitacoraClienteRepositoryEloquent implements BitacoraClienteRepository
{

      public function all()
      {
            return Bitacora_cliente::all();
      }

      public function create(array $bitacora_model)
      {

            $bitacora = new \Bitacora_cliente($bitacora_model);
            $bitacora->client_id = $bitacora_model['client']->id;

            if ($bitacora->save())
            {
                  return $bitacora;
            }
            return null;
      }

      public function delete($id)
      {
            return Bitacora_cliente::destroy($id);
      }

      public function find($id)
      {
            return Bitacora_cliente::find($id);
      }

      public function update($id, array $bitacora_model)
      {
            $bitacora = Bitacora_cliente::find($id);

            if (isset($bitacora))
            {
                  $bitacora->fill($bitacora_model);
                  $bitacora->client_id = $bitacora_model['client']->id;

                  if ($bitacora->save())
                  {

                        return $bitacora;
                  }
                  else
                  {
                        return null;
                  }
            }
            return null;
      }

}
