<?php

/**
 * Description of PagosListener
 *
 * @author carlos
 */
class PagosListener {

      public function store($object)
      {
            
            if ($object->tiempo_publicacion === "0")
            {
                  return true;
            }

            $pago              = new Pago;
            $pago->nombre      = 'Publicación de Contenido en Sphellar';
            $pago->descripcion = $object->nombre;

            if (get_class($object) == "Negocio")
            {
                  $pago->monto = Config::get('costos.' . get_class($object));
            }
            else
            {
                  $pago->monto = Config::get('costos.' . get_class($object) . "." . $object->tiempo_publicacion);
            }
            $pago->pagado = false;
            $pago->metodo = "";
            $pago->status = "inicio";
            $pago->cliente()->associate(Auth::user()->userable);

            if ($object->pago()->save($pago))
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

      /*
       * publica el contenido automaticamente en la aplicacion y envia un correo al usuario con sus datos
       */

      public function publicar_contenido($pago)
      {
            $objeto           = $pago->pagable;
            $objeto->publicar = true;
            if (get_class($objeto) != "Promocion")
            {
                  $objeto->is_especial = true;
            }
            $objeto->is_activo = true;
            if (!$objeto->updateUniques())
            {
                  return false;
            }            
      }

      /*
       * Avisa al usuario que su pago fue cancelado para que lo pueda volver a realizar
       */

      public function avisar_cancelacion($pago)
      {
            
      }

}
