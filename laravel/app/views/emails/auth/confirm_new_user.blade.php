<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Bienvenido a Sphellar</h2>

		<div>
			Para confirmar tus datos da click en el siguiente link: 
                        {{ HTML::linkAction('RemindersController@getReset','Cambiar Password',array($token))}}<br/>                  
			Una vez confirmado, podras ingresar con tus datos.
		</div>
	</body>
</html>
