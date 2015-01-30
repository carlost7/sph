<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EventosListener {
//Este método solo funciona para eventos
      public function update($evento)
      {
            //si es gratis, elimina el pago 
            if ($evento->tiempo_publicacion == 0)
            {
                  if (count($evento->pago))
                  {
                        $evento->pago->delete();
                  }
            }
            else
            {

                  if (count($evento->pago))
                  {
                        //si es de paga agrega el pago
                        $evento->pago->monto  = Config::get('costos.evento.' . Input::get('tiempo_publicacion'));
                        $evento->pago->pagado = false;
                        if ($evento->pago->save())
                        {
                              return true;
                        }
                        else
                        {
                              return false;
                        }
                  }
                  else
                  {
                        //Crear Pago de servicios
                        $pago              = new Pago;
                        $pago->nombre      = 'Publicación de Contenido en Sphellar';
                        $pago->descripcion = $evento->nombre;
                        $pago->monto       = Config::get('costos.' . get_class($evento));
                        $pago->pagado      = false;
                        $pago->metodo      = "";
                        $pago->status      = "inicio";
                        $pago->cliente()->associate(Auth::user()->userable);
                        if ($evento->pago()->save($pago))
                        {
                              return true;
                        }
                        else
                        {
                              return false;
                        }
                  }
            }
      }
}
