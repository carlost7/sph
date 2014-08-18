<?php

namespace Sph\Storage\Cliente;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Cliente;

class ClienteRepositoryEloquent implements ClienteRepository
{

      public function all()
      {
            return Cliente::all();
      }

      public function create(array $client_model)
      {

            $client = new Cliente($client_model);

            if ($client->save())
            {
                  $client->user()->save($client_model['user']);
                  return $client;
            }
            return null;
      }

      public function delete($id)
      {
            return Cliente::destroy($id);
      }

      public function find($id)
      {
            return Cliente::find($id);
      }

      public function update($id, array $client_model)
      {
            $client = Cliente::find($id);

            if (isset($client))
            {
                  $client->fill($client_model);

                  if ($client->save())
                  {
                        return $client;
                  }
                  else
                  {
                        return null;
                  }
            }
            return null;
      }

      public function activar_cliente($id)
      {
            $cliente = Cliente::find($id);
            $cliente->is_active=true;
            $cliente->token = '';
            
            if($cliente->save()){
                  return $cliente;
            }else{
                  return null;
            }
      }

}
