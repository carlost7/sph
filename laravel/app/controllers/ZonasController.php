<?php

class ZonasController extends \BaseController
{

      public function getZonas($estado_id)
      {
            $zonas = Zona::where('estado_id',$estado_id)->remember(60)->get();
            return Response::json($zonas);
      }

}
