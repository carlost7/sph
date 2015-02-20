<?php

class CategoriasController extends \BaseController {
      /*
       * obtiene las zonas de un estado especifico
       */

      public function getCategorias()
      {

            $cats = Categoria::All();
            return Response::json($cats);
      }

}
