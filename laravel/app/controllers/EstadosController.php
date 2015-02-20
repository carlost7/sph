<?php

class EstadosController extends \BaseController
{

      public function getEstados()
      {
            $estados = Estado::all();
            return Response::json($estados);
      }

}
