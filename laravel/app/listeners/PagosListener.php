<?php

use Sph\Storage\Pago\PagoRepository;

/**
 * Description of PagosListener
 *
 * @author carlos
 */
class PagosListener
{

      protected $pago;

      public function __construct(PagoRepository $pago)
      {
            $this->pago = $pago;
      }

      public function store($object)
      {
            $pago = new Pago;
            $pago->nombre = 'Publicación de Negocio';
            $pago->descripcion = $object->nombre;
            $pago->monto = Config::get('costos.'.  get_class($object));
            $pago->pagado = false;
            $pago->metodo = "";
            $pago->status = "inicio";
            $pago->cliente()->associate(Auth::user()->userable);

            if($object->pago()->save($pago)){
                  return true;
            }else{
                  return false;
            }
      }

      public function update($object)
      {
            
      }

      public function delete($object)
      {
            
      }

      /*
       * publica el contenido automaticamente en la aplicacion y envia un correo al usuario con sus datos
       */

      public function publicar_contenido(array $ids)
      {
            foreach ($ids as $id) {
                  $pago = $this->pago->find($id);
                  $this->pago->publicar_contenido($pago);
            }

            Mail::queue('emails.publicacion_contenido_pago', array(), function($message) use ($pago) {
                  $message->to($pago->cliente->user->email, $pago->cliente->nombre)->subject('Publicación de contenido en Sphellar');
            });
      }

      /*
       * Avisa al usuario que su pago fue cancelado para que lo pueda volver a realizar
       */

      public function avisar_cancelacion(array $ids)
      {
            $pago = $this->pago->find($ids[0]);
            Mail::queue('emails.pago_cancelado', array(), function($message) use ($pago) {
                  $message->to($pago->client->user->email, $pago->client->nombre)->subject('Pago cancelado');
            });
      }

}
