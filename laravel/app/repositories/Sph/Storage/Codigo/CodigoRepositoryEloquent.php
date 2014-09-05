<?php

namespace Sph\Storage\Codigo;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Codigo;

class CodigoRepositoryEloquent implements CodigoRepository
{

      public function all()
      {
            return Codigo::all();
      }

      public function create(array $codigo_model)
      {
            $codigo = new Codigo($codigo_model);
            if ($codigo->save())
            {
                  return $codigo;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Codigo::destroy($id);
      }

      public function find($id)
      {
            return Codigo::find($id);
      }

      public function update($id, array $codigo_model)
      {
            $codigo = Codigo::find($id);
            if (isset($codigo))
            {
                  $codigo->fill($codigo_model);
                  if($codigo->save()){
                        return $codigo;
                  }
            }

            return null;
      }

}
