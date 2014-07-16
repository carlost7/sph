<!DOCTYPE html>
<html lang="en-US">
        <head>
                <meta charset="utf-8">
        </head>
        <body>
                <h2>{{ $nombre }} bienvenido a Sphellar</h2>

                <div>
                        <p>Para confirmar tus datos da click en el siguiente link: </p>
                        {{ HTML::linkRoute('register.activate_client','Confirmar registro',array($token,$id))}}<br/>                        
                        <p>Una vez confirmado, podras ingresar con tus datos.</p>
                </div>
        </body>
</html>
