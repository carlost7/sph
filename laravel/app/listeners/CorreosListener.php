<?php


/**
 * Description of PagosListener
 *
 * @author carlos
 */
class CorreosListener
{

      public function enviar_correo_nuevo_usuario($miembro)
      {
            $data = array(
                  'nombre' => $miembro->username,
            );
            
            $email = $miembro->user->email;
            $nombre = $miembro->username;
            
            Mail::queue('emails.send_welcome_message', $data, function($message) use ($email,$nombre) {
                  $message->to($email, $nombre)->subject('Bienvenido a Sphellar');
            });
            return true;
      }

}
