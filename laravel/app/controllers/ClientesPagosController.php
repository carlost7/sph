<?php

use Carbon\Carbon;
use Illuminate\Events\Dispatcher;

class clientesPagosController extends \BaseController {

      public function __construct(Dispatcher $events)
      {
            parent::__construct();
            View::share('section', 'Pago');
      }

      /**
       * Display a listing of pagos
       *
       * @return Response
       */
      public function index()
      {
            $necesita_pagar = false;
            $pagos          = Auth::user()->userable->pagos()->orderBy('created_at', 'desc')->orderBy('pagado', 'asc')->paginate(5);

            //Check if value is in collection;
            $value = false;
            $key   = 'pagado';
            if (in_array($value, $pagos->lists($key)))
            {
                  $necesita_pagar = true;
            }

            return View::make('clientes.pagos.index')->with(array("pagos" => $pagos, 'necesita_pagar' => $necesita_pagar));
      }

      public function usar_codigo($id)
      {
            $pago = Pago::find($id);
            return View::make('clientes.pagos.codigo')->with('pago', $pago);
      }

      public function guardar_codigo($id)
      {
            $numero = Input::get('numero');
            $codigo = Codigo::where('numero', $numero)->where('usado', false)->first();
            if (isset($codigo))
            {
                  $codigo->usado = true;
                  $codigo->cliente()->associate(Auth::user()->userable);
                  if ($codigo->updateUniques())
                  {
                        $pago         = Pago::find($id);
                        $pago->pagado = true;
                        $pago->metodo = "Código Promocional";
                        $pago->status = "approved";
                        if ($pago->update())
                        {
                              Session::flash('message', 'Código satisfactorio');
                              return Redirect::route('clientes_pagos.index');
                        }
                        else
                        {
                              Session::flash('error', 'Error al realizar el pago');
                        }
                  }
                  else
                  {
                        Session::flash('error', 'El codigo no existe o ya fue utilizado');
                  }
            }
            else
            {
                  Session::flash('error', 'El codigo no existe o ya fue utilizado');
            }
            return Redirect::back();
      }

      public function avisar_marketing($id)
      {
            $pago = Pago::find($id);
            if (isset($pago))
            {
                  $aviso = new Aviso_cliente();
                  $aviso->cliente()->associate(Auth::user()->userable);                  
                  if ($pago->pagable->aviso()->save($aviso))
                  {
                        Session::flash('message', 'Un ejecutivo revisará el contenido y se le avisará por correo cuando este sea publicado');
                  }
                  else
                  {
                        Session::flash('message', 'Ocurrio un error al generar el aviso del ejecutivo, vuelva a intentarlo');
                  }
            }
            else
            {
                  Session::flash('error', 'El pago no corresponde al usuario');
            }
            return Redirect::back();
      }

}
