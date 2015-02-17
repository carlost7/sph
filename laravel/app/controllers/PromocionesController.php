<?php

class PromocionesController extends \BaseController {

      /**
       * Display the specified resource.
       * GET /negocios/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $promocion = Promocion::find($id);

            return View::make('contenido.show_promocion', compact('promocion'));
      }

}
