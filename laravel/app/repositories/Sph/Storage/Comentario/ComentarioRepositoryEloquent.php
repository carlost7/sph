<?php

namespace Sph\Storage\Comentario;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Comentario;

class ComentarioRepositoryEloquent implements ComentarioRepository
{

      public function all()
      {
            return Comentario::all();
      }

      public function create(array $comentario_model)
      {
            $comentario = new Comentario($comentario_model);

            $comentario->comentario_type = get_class($comentario_model['objeto']);
            $comentario->comentario_id = $comentario_model['objeto']->id;
            $comentario->usuario_id = $comentario_model['user_id'];

            if ($comentario->save())
            {
                  return $comentario;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Comentario::destroy($id);
      }

      public function find($id)
      {
            return Comentario::find($id);
      }

      public function update($id, array $comentario_model)
      {
            $comentario = Comentario::find($id);

            if (isset($comentario))
            {
                  $comentario->fill($comentario_model);
                  if($comentario->save()){
                        return $comentario;
                  }else{
                        return null;
                  }
            }
            return null;
      }

}