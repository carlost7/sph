@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Negocio</h2>

{{ Form::open(array('route'=>'publicar.clientes_negocios.store', 'files'=>true)) }}

<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('estado_id','Estado') }}
                  {{ Form::select('estado_id', $estados->lists('estado','id'),null,array('class'=>'form-control','id'=>'estados')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('zona_id','Zona') }}
                  {{ Form::select('zona_id', array(),null,array('class'=>'form-control', 'id'=>'zonas')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('categoria_id','Categoria') }}
                  {{ Form::select('categoria_id', $categorias->lists('categoria','id'),null,array('class'=>'form-control','id'=>'categorias')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('subcategoria_id','subcategoria') }}
                  {{ Form::select('subcategoria_id', array(),null,array('class'=>'form-control', 'id'=>'subcats')) }}
            </div>
      </div>
</div>

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre del negocio', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', Input::old('telefono'), array('placeholder' => 'teléfono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', Input::old('direccion'), array('placeholder' => 'dirección', 'class'=>'form-control')) }}
</div>   
<div class="form-group">
      {{ Form::label('webpage', 'Página web') }}            
      {{ Form::text('webpage', Input::old('webpage') ,array('placeholder'=>'página web','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico') }}            
      {{ Form::text('email', Input::old('email') ,array('placeholder'=>'correo electrónico','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', Input::old('descripcion'), array('placeholder' => 'descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">      
      <div class="row">
            <div class="col-sm-6">                  
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("lun",1,null,array('class'=>'desactivar','id'=>'lun')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('lun_ini','Lunes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="lun_ini" id="ini" value="{{ Input::old('lun_ini')}}">
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('lun_fin','Lunes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="lun_fin" id="fin" value="{{ Input::old('lun_ini')}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("mar",1,null,array('class'=>'desactivar','id'=>'mar')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mar_ini','Martes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="mar_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mar_fin','Martes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="mar_fin" value="{{ Input::old('lun_ini')}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("mie",1,null,array('class'=>'desactivar','id'=>'mie')) }}        
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mie_ini','Miercoles inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="mie_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mie_fin','Miercoles fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="mie_fin" value="{{ Input::old('lun_ini')}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                              
                        </div>
                  </div>
            </div>
            <div class="col-sm-6">                  
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("jue",1,null,array('class'=>'desactivar','id'=>'jue')) }}         
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('jue_ini','Jueves inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="jue_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('jue_fin','Jueves fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="jue_fin" value="{{ Input::old('lun_ini')}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("vie",1,null,array('class'=>'desactivar','id'=>'vie')) }}        
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('vie_ini','Viernes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="vie_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('vie_fin','Viernes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="vie_fin" value="{{ Input::old('lun_ini')}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("sab",1,null,array('class'=>'desactivar','id'=>'sab')) }}       
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('sab_ini','Sabado inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="sab_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                              
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('sab_fin','Sabado fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="sab_fin" value="{{ Input::old('lun_ini')}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("dom",1,null,array('class'=>'desactivar','id'=>'dom')) }}        
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('dom_ini','Domingo inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="dom_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('dom_fin','Domingo fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="dom_fin" value="{{ Input::old('lun_ini')}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                  </div>      
            </div>            
      </div>
</div>

<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("tc",true,Input::old("tc")) }} tc 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("td",true,Input::old("td")) }} td 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("estacionamiento",true,Input::old("estacionamiento")) }} estacionamiento 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("valet",true,Input::old("valet")) }} valet 
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("envio_domicilio",true,Input::old("envio_domicilio")) }} envio_domicilio 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("wifi",true,Input::old("wifi")) }} wifi 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("paqueteria",true,Input::old("paqueteria")) }} paqueteria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("mascotas",true,Input::old("mascotas")) }} mascotas 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("barra_libre",true,Input::old("barra_libre")) }} barra_libre 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("formal",true,Input::old("formal")) }} formal 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("camara_perm",true,Input::old("camara_perm")) }} camara_perm 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("restaurante",true,Input::old("restaurante")) }} restaurante 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("solo_mujeres",true,Input::old("solo_mujeres")) }} solo_mujeres 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("solo_hombres",true,Input::old("solo_hombres")) }} solo_hombres 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("personalizado",true,Input::old("personalizado")) }} personalizado 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("taller",true,Input::old("taller")) }} taller 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("clases_extra",true,Input::old("clases_extra")) }} clases_extra 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("informacion",true,Input::old("informacion")) }} informacion 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("lavanderia",true,Input::old("lavanderia")) }} lavanderia 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("gimnasio",true,Input::old("gimnasio")) }} gimnasio 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("restaurante",true,Input::old("restaurante")) }} restaurante 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("membresia",true,Input::old("membresia")) }} membresia 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("cafeteria",true,Input::old("cafeteria")) }} cafeteria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("pension",true,Input::old("pension")) }} pension 
                        </label>
                  </div>                  
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("cambios",true,Input::old("cambios")) }} cambios 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("devoluciones",true,Input::old("devoluciones")) }} devoluciones 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("bicicleta",true,Input::old("bicicleta")) }} bicicleta 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("alcohol",true,Input::old("alcohol")) }} alcohol 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">

                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("familiar",true,Input::old("familiar")) }} familiar 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("cita",true,Input::old("cita")) }} cita 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("pagos_diferidos",true,Input::old("pagos_diferidos")) }} pagos_diferidos 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("facturacion",true,Input::old("facturacion")) }} facturacion 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">

                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("mensajeria",true,Input::old("mensajeria")) }} mensajeria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("internacional",true,Input::old("internacional")) }} internacional 
                        </label>
                  </div>
            </div>
      </div>

</div>


{{ Form::hidden('add_images',false,array('id'=>'addimg')) }}      
@include('layouts.show_form_errors')
<div class="form-group">
      <button type="submit" class="btn btn-primary">Crear negocio</button>
      <button type="submit" class="btn btn-primary" onclick="$('#addimg').val('1')">Agregar Imagenes</button>
</div>        

{{ Form::close() }}

@stop

@section('scripts')
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}
{{ HTML::script('js/vendor/bootstrap-clockpicker.min.js') }}


<script>
      $('.file-inputs').bootstrapFileInput();

      $(function () {
            $('#uploadFile').on("change", function () {
                  var files = !!this.files ? this.files : [];
                  if (!files.length || !window.FileReader)
                        return; // no file selected, or no FileReader support

                  if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function () { // set image data as background of div
                              $("#imagepreview").css("background-image", "url(" + this.result + ")");
                        }
                  }
            });
      });

</script>

<script>
      $(document).ready(function () {
            $('#estados').change(function () {
                  var estado_id = $("#estados").val();
                  url = base_url + "/obtener_zona/" + estado_id;
                  $.get(url).done(function (data) {
                        $("#zonas").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              elemento = "<option value=" + resultado.id + ">" + resultado.zona + "</option>";
                              $("#zonas").append(elemento);
                        }
                  });
            }).trigger('change');

            $('#categorias').change(function () {
                  var categoria_id = $("#categorias").val();
                  url = base_url + "/obtener_subcategoria/" + categoria_id;
                  $.get(url).done(function (data) {
                        $("#subcats").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              elemento = "<option value=" + resultado.id + ">" + resultado.subcategoria + "</option>";
                              $("#subcats").append(elemento);
                        }
                  });
            }).trigger('change');
      });

</script>

<script>
      function save_map(event) {
            $('#latlng').val(event.latLng);
            createMarker_map({map: map, position: event.latLng});
      }
</script>

<script>
      $('.clockpicker').clockpicker();
</script>

<script>
      $('#ini').focusout(function () {
            valor = $('#ini').val();

            $(".timeini").val(valor);
      });
      $('#fin').focusout(function () {
            valor = $('#fin').val();

            $(".timefin").val(valor);
      });

      $(".desactivar").click(function (e) {
            var dia = $(this).attr('id');
            if ($(this).prop('checked')) {
                  $("input[name=" + dia + "_ini]").prop('disabled', true);
                  $("input[name=" + dia + "_fin]").prop('disabled', true);
            } else {
                  $("input[name=" + dia + "_ini]").prop('disabled', false);
                  $("input[name=" + dia + "_fin]").prop('disabled', false);
            }

      });
</script>
@stop