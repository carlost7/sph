<?php

class BaseController extends Controller
{
      
      
      /**
       * Setup the layout used by the controller.
       *
       * @return void
       */
      protected function setupLayout()
      {
            if (!is_null($this->layout))
            {
                  $this->layout = View::make($this->layout);
            }                        
      }
      
      protected function setupCatalog()
      {
            $subcategorias = \Subcategoria::with('categoria')->get();

            $categorias = [];
            foreach ($subcategorias as $subcat) {
                  if (!isset($categorias[$subcat->categoria->categoria]))
                  {
                        $categorias[$subcat->categoria->categoria] = [];
                  }
                  $categorias[$subcat->categoria->categoria][$subcat->id] = $subcat->subcategoria;
            }

            $zonas = \Zona::with('estado')->get();

            $estados = [];
            foreach ($zonas as $zona) {
                  if (!isset($estados[$zona->estado->estado]))
                  {
                        $estados[$zona->estado->estado] = [];
                  }
                  $estados[$zona->estado->estado][$zona->id] = $zona->zona;
            }
            
            View::share('categorias',$categorias);
            View::share('estados',$estados);
      }

}
