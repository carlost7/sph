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
      public function store($id, $clase)
      {

            $objeto = $this->$class->find($id);
            $resultado = array();
            if (isset($objeto))
            {

                  $commentValidator = new \Sph\Services\Validators\Comentario(Input::all(), 'save');

                  $resultado = array();

                  if ($commentValidator->passes())
                  {
                        $comentario_model = Input::all();
                        $comentario_model = array_add($comentario_model, 'user_id', Auth::user()->id);
                        $comentario_model = array_add($comentario_model, 'objeto', $objeto);

                        if ($this->comentario->create($comentario_model))
                        {
                              $status = "exito";
                              $resultado = array_add($resultado, "status", 'éxito');
                              $resultado = array_add($resultado, "mensaje", "Comentario Agregado con exito");
                              $resultado = array_add($resultado, "comentario", $comentario);
                        }
                  }
                  else
                  {

                        $resultado = array_add($resultado, "status", 'error');
                        $resultado = array_add($resultado, "mensaje", $commentValidator->getErrors());
                  }
            }
            else
            {
                  $resultado = array_add($resultado, "status", "error");
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
            $objeto = $this->$class->find($id);
            $resultado = array();
            if (isset($objeto))
            {
                  $commentValidator = new \Sph\Services\Validators\Comentario(Input::all(), 'save');

                  if ($commentValidator->passes())
                  {
                        $comentario_model = Input::all();
                        $comentario_model = array_add($comentario_model, 'user_id', Auth::user()->id);
                        $comentario_model = array_add($comentario_model, 'objeto', $objeto);

                        if ($this->comentario->create($comentario_model))
                        {
                              $resultado = array_add($resultado, "status", 'éxito');
                              $resultado = array_add($resultado, "mensaje", "Comentario Agregado con exito");
                              $resultado = array_add($resultado, "comentario", $comentario);
                        }
                  }
                  else
                  {

                        $resultado = array_add($resultado, "status", 'error');
                        $resultado = array_add($resultado, "mensaje", $commentValidator->getErrors());
                  }
            }
            else
            {
                  $resultado = array_add($resultado, "status", "error");
                  $resultado = array_add($resultado, "mensaje", "No existe el objeto a comentar");
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
            
            if ($this->comentario->delete($id))
            {
                  $resultado = array_add($resultado, "resultado", true);
            }
            else
            {
                  $resultado = array_add($resultado, "resultado", false);
            }     
            return Response::json($resultado);
      }

}
