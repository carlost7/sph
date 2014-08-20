<?php

namespace Sph\Storage\Zona;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Zona;

class ZonaRepositoryEloquent implements ZonaRepository
{

      public function all()
      {
            return Zona::all();
      }

      public function create(array $zona_model)
      {
            $zona = new Zona($zona_model);
            $zona->estado_id = $zona_model['estado_id'];
            if ($zona->save())
            {
                  return $zona;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Zona::destroy($id);
      }

      public function find($id)
      {
            return Zona::find($id);
      }

      public function update($id, array $zona_model)
      {
            $zona = Zona::find($id);
            if (isset($zona))
            {
                  if (isset($zona_model['email']))
                  {
                        $zona->email = $zona_model['email'];
                  }

                  if (isset($zona_model['password']))
                  {
                        $zona->password = \Hash::make($zona_model['password']);
                  }

                  if ($zona->save())
                  {
                        return $zona;
                  }
                  else
                  {
                        return null;
                  }
            }

            return null;
      }
      
      public function getZonaByEstado($estado_id){
            return Zona::where('estado_id',$estado_id)->get();
      }

}
