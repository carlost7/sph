<?php Sph\Storage\User;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */

use User;

class UserRepositoryEloquent implements UserRepository
{
    public function all()
    {
        return User::all();
    }

    public function create($input)
    {
        return User::create($input);
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
