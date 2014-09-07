<?php

use Sph\Storage\Codigo\CodigoRepository as Codigo;

/**
 * Description of PagosListener
 *
 * @author carlos
 */
class CodigosListener
{

      protected $codigo;

      public function __construct(Codigo $codigo)
      {
            $this->codigo = $codigo;
      }

      /*
       * publica el contenido automaticamente en la aplicacion y envia un correo al usuario con sus datos
       */

      public function enviar_codigo($cliente)
      {
            if (Config::get('params.enviar_codigo_correo'))
            {
                  $numero = rand(1000, 9999) . "-" . rand(1000, 9999) . "-" . rand(1000, 9999);
                  $codigo_model = array('numero' => $numero, 'cliente_id' => $cliente->id);
                  $this->codigo->create($codigo_model);

                  $data = array('nombre' => $cliente->nombre,
                        'codigo' => $numero,
                  );
                  Mail::queue('emails.send_promotional_code', $data, function($message) use ($cliente) {
                        $message->to($cliente->user->email, $cliente->nombre)->subject('Código promocional');
                  });
            }
      }

}
