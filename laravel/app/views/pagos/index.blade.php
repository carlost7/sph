<html>
      <head>
            <title>Prueba de recepcion de pagos</title>
      </head>
      <body>
            {{ Form::open(array('route'=>'recibir_notificacion_prueba')) }}
                  
                  <label for="exref">External reference</label>
                  <input type="text" value="@if(isset($exref)){{ $exref }}@endif" name="exref">
                  
                  <label for="status">Status</label>
                  <input type="text" value="@if(isset($status)){{ $status }}@endif" name="status">
                  
                  <input type="submit" value="Aceptar" name="aceptar">
                  
            {{ Form::close() }}
      </body>
</html>