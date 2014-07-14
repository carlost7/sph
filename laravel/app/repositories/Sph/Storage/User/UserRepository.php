<?php namespace Sph\Storage\User;

interface UserRepository
{
    public function all();
    
    public function find($id);
    
    public function create(array $user_model);
    
    public function update($id, $input);
    
    public function delete($id);    
            
}
