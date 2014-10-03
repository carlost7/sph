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
                  $zona->fill($zona_model);
                  $zona->estado_id=$zona_model['padre'];

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
            return Zona::where('estado_id',$estado_id)->remember(60)->get();
      }

      public function getZonaLike($word){
            return Zona::with('estado')->where('zona','LIKE',"%$word%")->take(25)->get();            
      }
      
}
