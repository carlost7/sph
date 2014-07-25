<?php

namespace Sph\Storage\Client;

interface ClientRepository
{

      public function all();

      public function find($id);

      public function create(array $client_model);

      public function update($id, array $client_model);

      public function delete($id);
      
      public function avisar_marketing($id);
}
