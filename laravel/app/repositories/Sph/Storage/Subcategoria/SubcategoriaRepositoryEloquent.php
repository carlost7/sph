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

                  if ($subcategoria->save())
                  {
                        return $subcategoria;
                  }
            }

            return null;
      }

      public function getSubcatByCategoria($categoria_id){
            return Subcategoria::where('id_categoria', $categoria_id)->get();
            
      }
      
}
