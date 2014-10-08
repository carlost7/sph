<?php

use Sph\Storage\Comentario\ComentarioRepository as Comentario;
use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Evento\EventoRepository as Evento;

class ComentariosController extends \BaseController
{

      protected $comentario;
      protected $negocio;
      protected $evento;

      public function __construct(Comentario $comentario, Negocio $negocio, Evento $evento)
      {
            $this->comentario = $comentario;
            $this->negocio = $negocio;
            $this->evento = $evento;
      }

      /**
       * Store a newly created comentario in storage.
       *
       * @return Response
       */
      public function store()
      {
            $id = Input::get('id');
            $clase = strtolower(Input::get('clase'));
            $resultado = array();

            if (!isset($id) || !isset($clase))
            {
                  $resultado = array_add($resultado, "status", false);
                  $resultado = array_add($resultado, "mensaje", "Se necesita el comentario y tipo");
                  return Response::json($resultado);
            }

            $objeto = $this->$clase->find($id);

            if (isset($objeto))
            {

                  $commentValidator = new \Sph\Services\Validators\Comentario(Input::all(), 'save');

                  $resultado = array();

                  if ($commentValidator->passes())
                  {
                        $comentario_model = Input::all();
                        $comentario_model = array_add($comentario_model, 'user_id', Auth::user()->id);
                        $comentario_model = array_add($comentario_model, 'objeto', $objeto);

                        $comentario = $this->comentario->create($comentario_model);
                        if (isset($comentario))
                        {
                              $status = "exito";
                              $resultado = array_add($resultado, "status", true);
                              $resultado = array_add($resultado, "mensaje", "Comentario Agregado con exito");
                              $resultado = array_add($resultado, "comentario", View::make('layouts.show_comentario')->with('comentario', $comentario)->render());
                        }
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
            $comentario = $this->comentario->find($id);
            $resultado = array();
            
            if (isset($comentario) && $comentario->usuario->id == Auth::user()->id)
            {
                  $commentValidator = new \Sph\Services\Validators\Comentario(Input::all(), 'update');

                  if ($commentValidator->passes())
                  {
                        $comentario_model = Input::all();
                        $comentario = $this->comentario->update($id,$comentario_model);
                        if (isset($comentario))
                        {
                              $resultado = array_add($resultado, "status", true);
                              $resultado = array_add($resultado, "mensaje", "Comentario Agregado con exito");
                              $resultado = array_add($resultado, "comentario", View::make('layouts.show_comentario')->with('comentario', $comentario)->render());
                        }
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

            $comentario = $this->comentario->find($id);
            if (isset($comentario))
            {
                  if ($comentario->usuario->id == Auth::user()->id)
                  {
                        if ($this->comentario->delete($id))
                        {

                              $resultado = array_add($resultado, "status", true);
                        }
                        else
                        {
                              $resultado = array_add($resultado, "status", false);
                        }
                  }
            }else{
                  $resultado = array_add($resultado, "status", false);
            }
            return Response::json($resultado);
      }

}
