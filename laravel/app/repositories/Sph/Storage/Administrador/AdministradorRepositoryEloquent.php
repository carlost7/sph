<?php

namespace Sph\Storage\Administrador;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Administrador;

class AdministradorRepositoryEloquent implements AdministradorRepository
{

      public function all()
      {
            return Administrador::all();
      }

      public function create(array $administrador_model)
      {

            $admin = new Administrador($administrador_model);
            if ($admin->save())
            {
                  $admin->user()->save($administrador_model['user']);
                  return $admin;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Administrador::destroy($id);
      }

      public function find($id)
      {
            return Administrador::find($id);
      }

      public function update($id, array $administrador_model)
      {
            $admin = new Administrador();            
            if ($admin->save())
            {
                  return $admin;
            }
            else
            {
                  return null;
            }
      }

}
