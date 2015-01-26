<?php

class ClientesNegociosImagenesController extends \BaseController {

      public function __construct()
      {
            parent::__construct();
            View::share('section', 'Negocio');
      }

      /**
       * Display a listing of clientesimagenesnegocios
       *
       * @return Response
       */
      public function index($negocio_id)
      {
            $negocio  = Negocio::with('imagenes')->find($negocio_id);
            
            $imagenes = $negocio->imagenes;

            return View::make('clientes.negocio_imagenes.index', compact('imagenes', 'negocio'));
      }

      /**
       * Store a newly created clientesimagenesnegocio in storage.
       *
       * @return Response
       */
      public function store($negocio_id)
      {
            $negocio = Negocio::find($negocio_id);

            $validator = Validator::make($data      = Input::all(), NegocioImagen::$rules);

            if(count($negocio->imagenes)>=10){
                  Session::flash("error","Unicamente se permiten 10 imagenes");
                  return Redirect::back();
            }
            
            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator);
            }
                        

            $imagen = new NegocioImagen(Input::all());
            $imagen->negocio()->associate($negocio);

            if ($imagen->save())
            {
                  Session::flash("message", "Imagen guardada con exito");
            }
            else
            {
                  Session::flash("error", "Error al guardar la imagen");
            }            
            return Redirect::route('publicar.clientes_negocio_imagenes.index',array($negocio->id));
      }

      /**
       * Remove the specified clientesimagenesnegocio from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($negocio_id,$id)
      {
            $negocio = Negocio::find($negocio_id);
            
            if (Auth::user()->userable->id !== $negocio->cliente->id)
            {
                  Session::flash('error', 'El negocio no pertenece al usuario actual');
                  return Redirect::back();
            }
            
            $imagen = NegocioImagen::find($id);
            
            if($imagen->delete()){
                  Session::flash("message",'Imagen eliminada');
            }else{
                  Session::flash("error",'Error al borrar la imagen');
            }
            
            return Redirect::route('publicar.clientes_negocio_imagenes.index',array($negocio->id));
      }

}
