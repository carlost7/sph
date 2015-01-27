<?php

class ComentariosController extends \BaseController {

      /**
       * Store a newly created comentario in storage.
       *
       * @return Response
       */
      public function store()
      {
            $id        = Input::get('id');
            $clase     = Input::get('clase');
            $resultado = array();

            if (!isset($id) || !isset($clase))
            {
                  $resultado = array_add($resultado, "status", false);
                  $resultado = array_add($resultado, "mensaje", "Se necesita el comentario y tipo");
                  return Response::json($resultado);
            }

            $objeto = $clase::find($id);

            if (isset($objeto))
            {

                  $comentario = new Comentario;
                  $comentario->usuario()->associate(Auth::user());                  
                  $comentario->comentario = "holas";
                  
                  if($comentario->save()){
                        
                        $objeto->comentarios()->save($comentario);                        
                        if(get_class($objeto) == Comentario::class) {
                              $comentario->topic_id = $objeto->topic->id;                              
                              $comentario->topic_type = get_class($objeto->topic);                              
                              $comentario->save();                              
                        }else{
                              $objeto->topics()->save($comentario);
                        }
                        
                        $status    = "exito";
                        $resultado = array_add($resultado, "status", true);
                        $resultado = array_add($resultado, "mensaje", "Comentario Agregado con exito");
                        $resultado = array_add($resultado, "comentario", View::make('layouts.show_comentario')->with(array('comentario' => $comentario, 'objeto' => $comentario->topic))->render());                        
                  }
                  else
                  {
                        $resultado = array_add($resultado, "status", false);
                        $resultado = array_add($resultado, "mensaje", $comentario->errors());
                  }
            }
            else
            {
                  $resultado = array_add($resultado, "status", false);
                  $resultado = array_add($resultado, "mensaje", "No existe el objeto a comentar");
            }

            return Response::json($resultado);
      }

      /**
       * Update the specified comentario in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $comentario = Comentario::find($id);
            $resultado  = array();

            if (isset($comentario) && $comentario->usuario->id == Auth::user()->id)
            {
                  if ($comentario->update())
                  {
                        $resultado = array_add($resultado, "status", true);
                        $resultado = array_add($resultado, "mensaje", "Comentario Agregado con exito");
                        $resultado = array_add($resultado, "comentario", View::make('layouts.show_comentario')->with('comentario', $comentario)->render());
                  }
                  else
                  {

                        $resultado = array_add($resultado, "status", false);
                        $resultado = array_add($resultado, "mensaje", $commentValidator->getErrors());
                  }
            }
            else
            {
                  $resultado = array_add($resultado, "status", false);
                  $resultado = array_add($resultado, "mensaje", "El comentario no pertenece al usuario activo");
            }

            return Response::json($resultado);
      }

      /**
       * Remove the specified comentario from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $resultado = array();

            $comentario = Comentario::find($id);

            if (isset($comentario))
            {
                  $objeto = $comentario->topic;
                  //Si el topic pertenece al usuario entonces lo eliminar
                  if ($objeto->cliente->user->id == Auth::user()->id)
                  {
                        if ($comentario->delete())
                        {
                              $resultado = array_add($resultado, "status", true);
                        }
                        else
                        {
                              $resultado = array_add($resultado, "status", false);
                        }
                  }
                  else
                  {
                        $resultado = array_add($resultado, "status", false);
                        $resultado = array_add($resultado, "mensaje", 'El comentario no pertenece al objeto');
                  }
            }

            return Response::json($resultado);
      }

}
