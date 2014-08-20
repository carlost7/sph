<?php

use Sph\Storage\Zona\ZonaRepository as Zona;

class ZonasController extends \BaseController
{

      protected $zona;
      
      public function __construct(Zona $zona)
      {
            $this->zona = $zona;
      }

      /**
       * Display a listing of the resource.
       * GET /zonas
       *
       * @return Response
       */
      public function index()
      {
            //
      }

      /**
       * Show the form for creating a new resource.
       * GET /zonas/create
       *
       * @return Response
       */
      public function create()
      {
            //
      }

      /**
       * Store a newly created resource in storage.
       * POST /zonas
       *
       * @return Response
       */
      public function store()
      {
            //
      }

      /**
       * Display the specified resource.
       * GET /zonas/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            //
      }

      /**
       * Show the form for editing the specified resource.
       * GET /zonas/{id}/edit
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            //
      }

      /**
       * Update the specified resource in storage.
       * PUT /zonas/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            //
      }

      /**
       * Remove the specified resource from storage.
       * DELETE /zonas/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            //
      }

      /*
       * 
       */

      public function getZonas($estado_id)
      {
            $zonas = $this->zona->getZonaByEstado($estado_id);
            return Response::json($zonas);
      }

}
