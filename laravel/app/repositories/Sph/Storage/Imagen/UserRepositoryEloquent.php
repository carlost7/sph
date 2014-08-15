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
            $user = new User();
            $user->email = $user_model['email'];
            $user->password = \Hash::make($user_model['password']);
            if ($user->save())
            {

                  return $user;
            }
            else
            {
                  return null;
            }
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
                  if (isset($user_model['email']))
                  {
                        $user->email = $user_model['email'];
                  }

                  if (isset($user_model['password']))
                  {
                        $user->password = \Hash::make($user_model['password']);
                  }

                  if ($user->save())
                  {
                        return $user;
                  }
                  else
                  {
                        return null;
                  }
            }

            return null;
      }

}
