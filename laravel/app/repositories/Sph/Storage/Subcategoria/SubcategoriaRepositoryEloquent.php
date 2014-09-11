<?php

namespace Sph\Storage\Subcategoria;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Subcategoria;

class SubcategoriaRepositoryEloquent implements SubcategoriaRepository
{

      public function all()
      {
            return Subcategoria::all();
      }

      public function create(array $subcat_model)
      {
            $subcategoria = new Subcategoria($subcat_model);
            $subcategoria->categoria_id = $subcat_model['categoria_id'];
            if ($subcategoria->save())
            {
                  return $subcategoria;
            }
            else
            {
                  return null;
            }
      }

      public function delete($id)
      {
            return Subcategoria::destroy($id);
      }

      public function find($id)
      {
            return Subcategoria::find($id);
      }

      public function update($id, array $subcat_model)
      {
            $subcategoria = Subcategoria::find($id);
            if (isset($subcategoria))
            {
                  $subcategoria->fill($subcat_model);

                  $subcategoria->categoria_id=$subcat_model['padre'];
                  
                  if ($subcategoria->save())
                  {
                        return $subcategoria;
                  }
            }

            return null;
      }

      public function getSubcatByCategoria($categoria_id){
            return Subcategoria::where('categoria_id', $categoria_id)->get();
            
      }
      
      public function getSubcategoriaLike($word)
      {
            return Subcategoria::with('categoria')->where('subcategoria','LIKE',"%$word%")->take(5)->get();
      }

      
}
