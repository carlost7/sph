<!DOCTYPE html>
<html lang="en-US">
      <head>
            <meta charset="utf-8">
      </head>
      <body>

            {{ HTML::linkRoute('register.activate_client','Confirmar registro',array($token,$id))}}<br/>                        

            {{ URL::to('/') }}
            
            

      </body>
</html>
