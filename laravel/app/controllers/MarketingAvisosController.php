<?php

class MarketingAvisosController extends \BaseController {

      public function __construct()
      {
            parent::__construct();
            View::share('section', 'Aviso');
      }

      /**
       * Display a listing of the resource.
       * GET /marketingclientesavisos
       *
       * @return Response
       */
      public function index()
      {
            //Filtra los usuarios pertenecientes a marketing que tienen avisos
            $clientes = Auth::user()->userable->clientes->filter(function($cliente) {
                  return $cliente->avisos->count() > 0;
            });

            return View::make('marketing.avisos.index', compact('clientes'));
      }

      /**
       * Display the specified resource.
       * GET /marketingclientesavisos/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {

            //Obtiene los datos de un cliente y los separa para presentarlos en la vista
            $clientee   = Cliente::find($id);
            $avisos     = $clientee->avisos;
            $contenidos = array();

            foreach ($avisos as $aviso) {
                  array_push($contenidos, $aviso->avisable);
            }

            $bitacoras = $clientee->bitacoras;

            return View::make('marketing.avisos.show', compact('cliente', 'contenidos', 'bitacoras'));
      }

      /**
       * Update the specified resource in storage.
       * PUT /marketingclientesavisos/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function publicar($id)
      {

            //Despues de hablar con el cliente, y definir si publicarlo o no 
            //creara una bitacora y guardara los datos del usuario,            
            $class  = Input::get('clase');
            $object = $class::find($id);
            if (isset($object))
            {

                  $bitacora        = new Bitacora_cliente;
                  $bitacora->fecha = \Carbon\Carbon::now();
                  $bitacora->cliente()->associate($object->cliente);
                  $bitacora->save();

                  //Activa el contenido del usuario y elimina el aviso de la pagina de marketing
                  if (Input::get('publicar'))
                  {
                        $object->publicar               = true;
                        $object->is_activo              = true;
                        $object->fecha_nueva_activacion = \Carbon\Carbon::now()->addMonth();
                        if ($object->updateUniques())
                        {
                              $data = array(
                                  'tipo' => Input::get('clase'),
                              );

                              Mail::queue('emails.publicacion_contenido_gratuito', $data, function($message) use ($object) {
                                    $message->to($object->cliente->user->email, $object->cliente->nombre)->subject('publicacion de contenido en Sphellar');
                              });

                              Session::flash('message', 'Publicado exitosamente');
                        }
                        else
                        {
                              Session::flash('error', 'Error al publicar el contenido');
                        }
                  }
                  else
                  {
                        $data = array(
                            'tipo' => Input::get('clase'),
                        );
                        Mail::queue('emails.contenido_no_publicado', $data, function($message) use ($object) {
                              $message->to($object->cliente->user->email, $object->cliente->nombre)->subject('publicacion de contenido en Sphellar');
                        });
                  }
                  //Elimina el aviso del cliente 
                  $this->aviso_cliente->delete($object->aviso->id);
            }
            else
            {
                  Session::flash('error', 'No existe ese id');
            }

            return Redirect::back();
      }

      /**
       * Remove the specified resource from storage.
       * DELETE /marketingclientesavisos/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {

            $aviso = Aviso_cliente::find($id);

            if ($aviso->delete())
            {
                  Session::flash('message', 'Aviso eliminado correctamente');
            }
            else
            {
                  Session::flash('error', 'Error al eliminar el aviso');
            }
            return Redirect::back();
      }

}
