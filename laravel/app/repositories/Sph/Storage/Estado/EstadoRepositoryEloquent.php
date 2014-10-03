<?php

namespace Sph\Storage\Estado;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Estado;

class EstadoRepositoryEloquent implements EstadoRepository
{

      public function all()
      {
            return Estado::all();            
      }

      public function create(array $estado_model)
      {
            $estado = new Estado($estado_model);
            if ($estado->save())
            {

                  return $estado;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Estado::destroy($id);
      }

      public function find($id)
      {
            return Estado::find($id);
      }

      public function update($id, array $estado_model)
      {
            $estado = Estado::find($id);
            if (isset($estado))
            {
                  $estado->fill($estado_model);

                  if ($estado->save())
                  {
                        return $estado;
                  }
            }
            return null;
      }

      public function getEstadoLike($word)
      {
            return Estado::where('estado','LIKE',"%$word%")->take(4)->get();
      }

}
