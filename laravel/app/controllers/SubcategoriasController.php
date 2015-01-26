<?php

class SubcategoriasController extends \BaseController {
      /*
       * obtiene las zonas de un estado especifico
       */

      public function getSubcategorias($categoria_id)
      {

            $subcats = Subcategoria::where('categoria_id', $categoria_id)->remember(60)->get();
            return Response::json($subcats);
      }

}
