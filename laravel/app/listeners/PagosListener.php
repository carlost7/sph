<?php

use Sph\Storage\Pago\PagoRepository as Pago;

/**
 * Description of PagosListener
 *
 * @author carlos
 */
class PagosListener
{

      protected $pago;

      public function __construct(Pago $pago)
      {
            $this->pago = $pago;
      }

      public function publicar_contenido(array $ids)
      {
            foreach ($ids as $id)
            {
                  $pago = $this->pago->find($id);
                  $this->pago->publicar_contenido($pago);
            }

            Mail::queue('emails.publicacion_contenido_pago', array(), function($message) use ($pago)
            {
                  $message->to($pago->client->user->email, $pago->client->name)->subject('Publicacion de contenido en Sphellar');
            });
      }

      public function avisar_cancelacion(array $ids)
      {
            
      }

}
