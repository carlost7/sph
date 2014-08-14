<!DOCTYPE html>
<html lang="en-US">
      <head>
            <meta charset="utf-8">
      </head>
      <body>
            <h2>Publicación de contenido</h2>

            <div>
                  @if(isset($tipo))
                  <p>Tu {{ $tipo }} se ha publicado en Sphellar</p>
                  @else
                  <p>Tu contenido se ha publicado en Sphellar</p>
                  @endif
                  <p>Entra a tu panel de control de Sphellar para agregar los datos especiales</p>
            </div>

      </body>
</html>
