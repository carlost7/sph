<?php

use Illuminate\Events\Dispatcher;

class clientesImagenesController extends \BaseController
{
      public function __construct()
      {
            parent::__construct();
            $this->events = new Dispatcher;
            View::share('section', 'Negocio');
      }

      /**
       * Display a listing of negocios
       *
       * @return Response
       */
      public function index($model,$object_id)
      {
            $object = $model::find($object_id);
            if(!$object->userable->id == Auth::user()->id){
                Session::flash('error','El objeto no pertenece al usuario');
                return Redirect::back();
            }
            $imagenes = $object->imagenes;
            return View::make('clientes.imagenes.index', compact('imagenes'));
      }

      /**
       * Show the form for creating a new negocio
       *
       * @return Response
       */
      public function create($model,$object_id)
      {
            $object = $model::find($object_id);
            if(!$object->userable->id == Auth::user()->id){
                Session::flash('error','El objeto no pertenece al usuario');
                return Redirect::back();
            }
            $imagenes = $object->imagenes;
            
      }

      /**
       * Store a newly created negocio in storage.
       *
       * @return Response
       */
      public function store($model,$object_id)
      {
            $object = $model::find($object_id);
            if(!$object->userable->id == Auth::user()->id){
                Session::flash('error','El objeto no pertenece al usuario');
                return Redirect::back();
            }
            $imagenes = $object->imagenes;

      }

      /**
       * Display the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($model,$object_id,$id)
      {
            $object = $model::find($object_id);
            if(!$object->userable->id == Auth::user()->id){
                Session::flash('error','El objeto no pertenece al usuario');
                return Redirect::back();
            }
            $imagenes = $object->imagenes;
      }

      /**
       * Show the form for editing the specified negocio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($model,$object_id,$id)
      {
            $object = $model::find($object_id);
            if(!$object->userable->id == Auth::user()->id){
                Session::flash('error','El objeto no pertenece al usuario');
                return Redirect::back();
            }
            $imagenes = $object->imagenes;
      }

      /**
       * Update the specified negocio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($model,$object_id,$id)
      {
            $object = $model::find($object_id);
            if(!$object->userable->id == Auth::user()->id){
                Session::flash('error','El objeto no pertenece al usuario');
                return Redirect::back();
            }
            $imagenes = $object->imagenes;
      }

      /**
       * Remove the specified negocio from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($model,$object_id,$id)
      {
            $object = $model::find($object_id);
            if(!$object->userable->id == Auth::user()->id){
                Session::flash('error','El objeto no pertenece al usuario');
                return Redirect::back();
            }
            $imagenes = $object->imagenes;
      }

}
