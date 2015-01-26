<?php

class ClientesEventosImagenesController extends \BaseController {

      public function __construct()
      {
            parent::__construct();
            View::share('section', 'Evento');
      }

      /**
       * Display a listing of clientesimageneseventos
       *
       * @return Response
       */
      public function index($evento_id)
      {
            $evento  = Evento::with('imagenes')->find($evento_id);
            
            $imagenes = $evento->imagenes;

            return View::make('clientes.eventos_imagenes.index', compact('imagenes', 'evento'));
      }

      /**
       * Store a newly created clientesimagenesevento in storage.
       *
       * @return Response
       */
      public function store($evento_id)
      {
            $evento = Evento::find($evento_id);

            $validator = Validator::make($data      = Input::all(), EventoImagen::$rules);

            if(count($evento->imagenes)>=10){
                  Session::flash("error","Unicamente se permiten 10 imagenes");
                  return Redirect::back();
            }
            
            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator);
            }
                        

            $imagen = new EventoImagen(Input::all());
            $imagen->evento()->associate($evento);

            if ($imagen->save())
            {
                  Session::flash("message", "Imagen guardada con exito");
            }
            else
            {
                  Session::flash("error", "Error al guardar la imagen");
            }            
            return Redirect::route('publicar.clientes_evento_imagenes.index',array($evento->id));
      }

      /**
       * Remove the specified clientesimagenesevento from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($evento_id,$id)
      {
            $evento = Evento::find($evento_id);
            
            if (Auth::user()->userable->id !== $evento->cliente->id)
            {
                  Session::flash('error', 'El evento no pertenece al usuario actual');
                  return Redirect::back();
            }
            
            $imagen = EventoImagen::find($id);
            
            if($imagen->delete()){
                  Session::flash("message",'Imagen eliminada');
            }else{
                  Session::flash("error",'Error al borrar la imagen');
            }
            
            return Redirect::route('publicar.clientes_evento_imagenes.index',array($evento->id));
      }

}
