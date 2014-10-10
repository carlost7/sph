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
            //Buscamos a todos los marketings con sus clientes
            $marketings = Marketing::with('clientes')->get();
            $conteo = array();
            //creamos un array con el conteo de clientes por marketing
            foreach ($marketings as $marketing)
            {
                  $conteo = array_add($conteo, $marketing->id, count($marketing->clientes));
            }

            //Si el array tiene datos
            if (sizeof($conteo))
            {
                  //Obtenemos los registros que tengan menos clientes
                  $less_client_marketings = array_keys($conteo, min($conteo));
                  
                  //Seleccionamos un marketing al azar
                  $marketing = Marketing::find($less_client_marketings[rand(0, count($less_client_marketings) - 1)]);
                  
                  //Guardamos con el cliente
                  if ($marketing->clientes()->save($client_object))
                  {
                        return $marketing;
                  }
                  else
                  {
                        return null;
                  }
            }
            else
            {
                  return null;
            }
      }

}
