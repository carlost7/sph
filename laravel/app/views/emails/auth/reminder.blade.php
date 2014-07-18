<!DOCTYPE html>
<html lang="en-US">
      <head>
            <meta charset="utf-8">
      </head>
      <body>
            <h2>Cambio de Password en Sphellar</h2>

            <div>
                  Para modificar la contraseña de acceso a Sphellar rellena el formulario en la pagina siguiente: 
                  {{ HTML::linkAction('RemindersController@getReset','Cambiar Password',array($token))}}<br/>                  
                  Este link dejará de funcionar en {{ Config::get('auth.reminder.expire', 60) }} minutos.
            </div>
      </body>
</html>
