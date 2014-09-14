<?php

namespace Sph\Storage\User;

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

      public function create(array $user_model)
      {
            $user = new User($user_model);
            if ($user_model['password'])
            {
                  $user->password = \Hash::make($user_model['password']);
            }
            $user->save();
            return $user;
      }

      public function delete($id)
      {
            return User::destroy($id);
      }

      public function find($id)
      {
            return User::find($id);
      }

      public function update($id, array $user_model)
      {
            $user = User::find($id);
            if (isset($user))
            {
                  $user->fill($user_model);
                  if ($user_model['password'])
                  {
                        $user->password = \Hash::make($user_model['password']);
                  }
                  $user->save();
            }

            return null;
      }

}
