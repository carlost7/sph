<?php

/**
 * Description of PagosListener
 *
 * @author carlos
 */
class CodigosListener {
      /*
       * publica el contenido automaticamente en la aplicacion y envia un correo al usuario con sus datos
       */

      public function enviar_codigo($cliente)
      {
            if (Config::get('params.enviar_codigo_correo'))
            {
                  $numero         = rand(1000, 9999) . "-" . rand(1000, 9999) . "-" . rand(1000, 9999);
                  $codigo         = new Codigo;
                  $codigo->numero = $numero;
                  $codigo->usado  = false;
                  $codigo->cliente()->associate($cliente);
                  if ($codigo->save())
                  {
                        $data   = array('nombre' => $cliente->nombre,
                            'codigo' => $numero,
                        );
                        $email  = $cliente->user->email;
                        $nombre = $cliente->nombre;
                        Mail::queue('emails.send_promotional_code', $data, function($message) use ($email, $nombre) {
                              $message->to($email, $nombre)->subject('Código promocional');
                        });
                        return true;
                  }
                  else
                  {
                        return false;
                  }
            }
      }

}
