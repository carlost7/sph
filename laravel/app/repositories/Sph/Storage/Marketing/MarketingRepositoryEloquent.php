<?php

namespace Sph\Storage\Marketing;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Marketing;

class MarketingRepositoryEloquent implements MarketingRepository
{

      public function all()
      {
            return Marketing::all();
      }

      public function create(array $marketing_model)
      {

            $marketing = new Marketing($marketing_model);

            if ($marketing->save())
            {
                  $marketing->user()->save($marketing_model['user']);
                  return $marketing;
            }
            return null;
      }

      public function delete($id)
      {
            return Marketing::destroy($id);
      }

      public function find($id)
      {
            return Marketing::find($id);
      }

      public function update($id, array $marketing_model)
      {
            $marketing = Marketing::find($id);

            if (isset($marketing))
            {
                  $marketing->fill($marketing_model);

                  if ($marketing->save())
                  {
                        return $marketing;
                  }
                  else
                  {
                        return null;
                  }
            }
            return null;
      }

      public function asignar_cliente($client_object)
      {
            $marketings = Marketing::with('clientes')->get();
            $conteo = array();
            foreach ($marketings as $marketing)
            {
                  $conteo = array_add($conteo, $marketing->id, $marketing->clientes->count());
            }

            if (sizeof($conteo))
            {
                  $conteo = array_keys($conteo, min($conteo));
                  $marketing = Marketing::find($conteo[rand(0, count($conteo) - 1)]);
                  if ($marketing->clientes()->save($client_object))
                  {
                        return $marketing;
                  }else{
                        return null;
                  }
            }
            else
            {
                  return null;
            }
      }

}
