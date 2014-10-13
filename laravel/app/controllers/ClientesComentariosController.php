<?php

use Sph\Storage\Comentario\ComentarioRepository as Comentario;
use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Evento\EventoRepository as Evento;

class ClientesComentariosController extends \BaseController
{

      protected $comentario;
      protected $negocio;
      protected $evento;

      public function __construct(Comentario $comentario, Negocio $negocio, Evento $evento)
      {
            parent::__construct();

            $this->comentario = $comentario;
            $this->negocio = $negocio;
            $this->evento = $evento;
            View::share('section', 'Cliente');
      }

      public function index()
      {
            $id = Input::get('id');
            $clase = strtolower(Input::get('clase'));

            if (isset($id) && isset($clase))
            {
                  $objeto = $this->$clase->find($id);
                  $comentarios = $objeto->comentarios;

                  View::share('section', Input::get('clase'));

                  return View::make('clientes.comentarios.index')->with(array('comentarios' => $comentarios, 'objeto' => $objeto));
            }
            else
            {
                  Session::flash('error', 'No existe el objeto');
            }
            return Redirect::back();
      }
      
      
      /**
       * Store a newly created resource in storage.
       * POST /clientescomentarios
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

                        if (get_class($objeto) == \Comentario::class)
                        {
                              $comentario_model = array_add($comentario_model, 'topic_id', $objeto->topic_id);
                              $comentario_model = array_add($comentario_model, 'topic_type', $objeto->topic_type);
                        }
                        else
                        {
                              $comentario_model = array_add($comentario_model, 'topic_id', $objeto->id);
                              $comentario_model = array_add($comentario_model, 'topic_type', get_class($objeto));
                        }

                        $comentario = $this->comentario->create($comentario_model);
                        if (isset($comentario))
                        {
                              $status = "exito";
                              $resultado = array_add($resultado, "status", true);
                              $resultado = array_add($resultado, "mensaje", "Comentario Agregado con exito");
                              $resultado = array_add($resultado, "comentario", View::make('layouts.show_comentario_cliente')->with(array('comentario' => $comentario, 'objeto' => $comentario->topic))->render());
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
                        $comentario = $this->comentario->update($id, $comentario_model);
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
       * Remove the specified resource from storage.
       * DELETE /clientescomentarios/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $resultado = array();

            $id_objeto = Input::get('id_objeto');
            $clase = strtolower(Input::get('clase'));

            if (isset($id_objeto) && isset($clase))
            {
                  $comentario = $this->comentario->find($id);
                  $objeto = $this->$clase->find($id_objeto);
            }
            else
            {
                  $resultado = array_add($resultado, "status", false);
                  $resultado = array_add($resultado, "mensaje", 'Error al obtener datos del objeto');
                  return Response::json($resultado);
            }

            if (isset($comentario) && isset($objeto))
            {
                  
                  $comentarios = $objeto->topics->filter(function($topic) use ($id)
                  {
                        return $topic->id = $id;
                  });


                  if (isset($comentarios))
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
                  else
                  {
                        $resultado = array_add($resultado, "status", false);
                        $resultado = array_add($resultado, "mensaje", 'El comentario no pertenece al objeto');
                  }
            }
            else
            {
                  $resultado = array_add($resultado, "status", false);
                  $resultado = array_add($resultado, "mensaje", 'No existe el objeto');
            }
            return Response::json($resultado);
      }

}
