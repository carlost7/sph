<?php

namespace Sph\Storage\Categoria;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Categoria;

class CategoriaRepositoryEloquent implements CategoriaRepository
{

      public function all()
      {
            return Categoria::all();
      }

      public function create(array $categoria_model)
      {
            $categoria = new Categoria($categoria_model);
            if ($categoria->save())
            {
                  return $categoria;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Categoria::destroy($id);
      }

      public function find($id)
      {
            return Categoria::find($id);
      }

      public function update($id, array $categoria_model)
      {
            $categoria = Categoria::find($id);
            if (isset($categoria))
            {
                  $categoria->fill($categoria_model);
                  if($categoria->save()){
                        return $categoria;
                  }
            }

            return null;
      }
      
      public function getCategoriaLike($word)
      {
            return Categoria::where('categoria','LIKE',"%$word%")->take(2)->get();
      }


}
