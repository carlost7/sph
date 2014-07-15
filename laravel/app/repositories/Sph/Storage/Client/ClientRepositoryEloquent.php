<?php

namespace Sph\Storage\Client;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Client;

class ClientRepositoryEloquent implements ClientRepository
{

        public function all()
        {
                return Client::all();
        }

        public function create(array $client_model)
        {

                $client = new Client($client_model);

                if ($client->save())
                {
                        $client->user()->save($client_model['user']);
                        return $client;
                }
                return null;
        }

        public function delete($id)
        {
                return Client::destroy($id);
        }

        public function find($id)
        {
                return Client::find($id);
        }

        public function update($id, array $client_model)
        {
                $client = Client::find($id);

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

}
