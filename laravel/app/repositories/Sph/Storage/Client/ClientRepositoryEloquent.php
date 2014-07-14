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
                return User::all();
        }

        public function create(array $client_model)
        {

                $client = new Client();
                $client->name = $client_model['name'];
                $client->telephone = $client_model['telephone'];
                $client->is_active = $client_model['is_active'];
                $client->token = $client_model['token'];
                
                if($client->save()){
                    $client->user()->save($client_model['user']);    
                    return $client;
                }
                return null;
                
        }

        public function delete($id)
        {
                return User::destroy($id);
        }

        public function find($id)
        {
                return User::find($id);
        }

        public function update($id, $input)
        {
                return User::where($id)->update($user_model);
        }

//put your code here
}
