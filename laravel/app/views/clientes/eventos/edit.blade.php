@extends('layouts.client_dashboard_master')

@section('content')
@if($evento)
<h2>Editar: {{ $evento->nombre }}</h2>

{{ Form::model($evento, array('route' => array('publicar.clientes_eventos.update', $evento->id), 'method' => 'PUT','files'=>true)) }}

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', $evento->nombre, array('placeholder' => 'nombre del negocio', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('fecha_inicio', 'Fecha de inicio') }}      
                  <div class='input-group date' id='datetimepicker1' data-date-format="DD-MM-YYYY">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type='text' class="form-control" name="fecha_inicio" value="{{ date('d-m-Y',strtotime($evento->fecha_inicio)) }}" placeholder="fecha de inicio" />
                  </div>                  
            </div>      
            <div class="col-sm-6">
                  {{ Form::label('fecha_fin', 'Fecha de finalización') }}      
                  <div class='input-group date' id='datetimepicker2' data-date-format="DD-MM-YYYY">
                        <input type='text' class="form-control" name="fecha_fin" value="{{ date('d-m-Y',strtotime($evento->fecha_fin)) }}" placeholder="fecha de finalización" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('hora_inicio','Hora inicio') }}
                  <div class="input-group clockpicker" data-autoclose="true">
                        <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                        </span>
                        <input type="text" class="form-control" name="hora_inicio" value="{{ date('H:i',strtotime($evento->hora_inicio))}}">
                  </div> 
            </div>
            <div class="col-sm-6">
                  {{ Form::label('hora_fin','Hora termino') }}
                  <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" class="form-control" name="hora_fin" value="{{ date('H:i',strtotime($evento->hora_fin))}}">
                        <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                        </span>
                  </div> 
            </div>
      </div>
</div>        
<div class="form-group">
      {{ Form::label('lugar', 'Lugar') }}
      {{ Form::text('lugar', $evento->lugar, array('placeholder' => 'lugar', 'class'=>'form-control')) }}
</div>  
<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', $evento->direccion, array('placeholder' => 'dirección', 'class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', $evento->descripcion, array('placeholder' => 'descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', $evento->telefono, array('placeholder' => 'teléfono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('mas_info','Más información') }}
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('moneda','Moneda') }}
                  {{ Form::select('moneda', array('MEX' => 'Pesos', 'USD' => 'Dólares'),$evento->masInfo->moneda,array('class'=>'form-control')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('costo','Costo') }}
                  {{ Form::text('costo', $evento->masInfo->costo, array('placeholder' => '00.00', 'class'=>'form-control')) }}
            </div>            
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-4">
                  {{ Form::label('min_edad','Edad mínima') }}
                  {{ Form::text('min_edad', $evento->masInfo->min_edad, array('placeholder' => 'edad mínima', 'class'=>'form-control')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('max_edad','Edad máxima') }}
                  {{ Form::text('max_edad', $evento->masInfo->max_edad, array('placeholder' => 'edad máxima', 'class'=>'form-control')) }}
            </div> 
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('alcohol',true,$evento->masInfo->alcohol) }}            
                              ¿Cuenta con alcohol?
                        </label>
                  </div>
            </div>
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('pagos','Pagos Aceptados') }}
            </div>            
      </div>
      <div class="row">
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('tc', true,$evento->masInfo->tc) }}      
                              Tarjeta de crédito
                        </label>
                  </div>
            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('td', true,$evento->masInfo->td) }}      
                              Tarjeta de debito
                        </label>
                  </div>
            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('efectivo', true,$evento->masInfo->efectivo) }}
                              Efectivo
                        </label>                        
                  </div>
            </div>
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('estado','Estado') }}
                  {{ Form::select('estado', $estados->lists('estado','id'),$evento->estado->id,array('class'=>'form-control','id'=>'estados')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('zona','Zona') }}
                  {{ Form::select('zona', array(),(count($evento->zona))?$evento->zona->id:'',array('class'=>'form-control', 'id'=>'zonas')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('categoria','Categoria') }}
                  {{ Form::select('categoria', $categorias->lists('categoria','id'),$evento->categoria->id,array('class'=>'form-control','id'=>'categorias')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('subcategoria','subcategoria') }}
                  {{ Form::select('subcategoria', array(), (count($evento->subcategoria))?$evento->subcategoria->id:'',array('class'=>'form-control', 'id'=>'subcats')) }}
            </div>
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Imágen') }}
                  <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
                  @if($evento->imagen)
                  <div id="imagepreview" class="imagepreview" style="background-image: url({{ Config::get('params.path_serve_image_transform').Image::path($evento->imagen->path.$evento->imagen->nombre,'resizeCrop',250,250,'left','top') }})"></div>
                  {{ Form::label('alt','Descripción') }}
                  {{ Form::text('alt',$evento->imagen->alt,array('placeholder' => 'descripción', 'class'=>'form-control')) }}
                  @else
                  <div id="imagepreview" class="imagepreview"></div>
                  {{ Form::label('alt','Descripción') }}
                  {{ Form::text('alt',null,array('placeholder' => 'descripción', 'class'=>'form-control')) }}
                  @endif
            </div>      
      </div>
</div>
<div class="form-group">
      {{ Form::label('web', 'Página web') }}            
      {{ Form::text('web', ($evento->especial) ? $evento->especial->web : '' ,array('placeholder'=>'página web','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico') }}            
      {{ Form::text('email', ($evento->especial) ? $evento->especial->email : '' ,array('placeholder'=>'correo electrónico','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('mapa', 'Mapa') }}            
      {{ Form::hidden('mapa',($evento->especial) ? $evento->especial->mapa : '',array('id'=>'latlng')) }}
      {{ $mapa['js'] }}
      {{ $mapa['html'] }}      
</div>  

@if($editar_publicacion)
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('publicacion','Publicar contenido') }}
            </div>            
      </div>
      <div class="row">
            <div class="col-sm-12">
                  <label id="mod_pub">
                        {{ Form::checkbox('modificar_publicacion',true,false,array('id'=>'modificar_publicacion')) }} 
                        Modificar fechas de publicación
                  </label>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6 publicacion" >
                  {{ Form::label('publicacion_inicio', 'Inicio de publicación') }}
                  <div class='input-group date' id='datetimepicker3' data-date-format="DD-MM-YYYY">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type='text' class="form-control" name="publicacion_inicio" value="{{ date('d-m-Y',strtotime($evento->publicacion_inicio)) }}" id="vig_ini" placeholder="fecha de inicio de la publicación" />
                  </div>
            </div>
            <div class="col-sm-6 publicacion" >
                  {{ Form::label('publicacion_fin', 'Fin de la publicación') }}      
                  <div class='input-group date' id='datetimepicker4' data-date-format="DD-MM-YYYY">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type='text' class="form-control" name="publicacion_fin" value="{{ date('d-m-Y',strtotime($evento->publicacion_fin)) }}" id="vig_fin" placeholder="fecha de finalización de la publicación" readonly="true"/>
                  </div>
            </div>
      </div>      
</div>
<div class="form-group" id="editar_publicacion">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('vigencia','Tiempo de la publicación') }}                  
            </div>
      </div>      

      <div class="row">
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="1" class="publicacion">
                              {{ Form::radio('tiempo_publicacion',1) }}            
                              1 Mes
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="2" class="publicacion">                               
                              {{ Form::radio('tiempo_publicacion',2) }}                       
                              2 Meses
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="3" class="publicacion">                              
                              {{ Form::radio('tiempo_publicacion',3) }}                       
                              3 Meses
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="gratis" class="publicacion">
                              {{ Form::radio('tiempo_publicacion','gratis') }}            
                              Gratis
                        </label>
                  </div>
            </div>

      </div>      
</div>
@endif


{{ Form::hidden('add_images',false,array('id'=>'addimg')) }}                        
@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar evento</button>
      <button type="submit" class="btn btn-primary" onclick="$('addimg').val('1')">Agregar imágenes</button>
</div>

{{ Form::close() }}


@else
<h2>No seleccionó ningún evento para editar</h2>

@endif

@stop

@section('scripts')
{{ HTML::script('js/vendor/moment.js') }}
{{ HTML::script('js/vendor/bootstrap-datepicker.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.es.js') }}
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}
{{ HTML::script('js/vendor/bootstrap-clockpicker.min.js') }}

<script>

      $('#datetimepicker1').datetimepicker({
            language: 'es',
            pickTime: false,
      })


      $('#datetimepicker2').datetimepicker({
            language: 'es',
            pickTime: false,
      });

      $('#datetimepicker3').datetimepicker({
            language: 'es',
            pickTime: false,
      });
</script>

<script>
      $('.file-inputs').bootstrapFileInput();
      $(function() {
            $('#uploadFile').on("change", function() {
                  var files = !!this.files ? this.files : [];
                  if (!files.length || !window.FileReader)
                        return; // no file selected, or no FileReader support

                  if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function() { // set image data as background of div
                              $("#imagepreview").css("background-image", "url(" + this.result + ")");
                        }
                  }
            });
      });
</script>

<script>
      $(function() {
            $('#estados').change(function() {
                  var estado_id = $("#estados").val();
                  url = base_url + "/obtener_zona/" + estado_id;
                  $.get(url).done(function(data) {
                        $("#zonas").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              if (resultado.id === '{{(count($evento->zona))?$evento->zona->id:""}}') {
                                    elemento = "<option value=" + resultado.id + " selected >" + resultado.zona + "</option>";
                              } else {
                                    elemento = "<option value=" + resultado.id + ">" + resultado.zona + "</option>";
                              }
                              $("#zonas").append(elemento);
                        }
                  });
            }).trigger('change');
            $('#categorias').change(function() {
                  var categoria_id = $("#categorias").val();
                  url = base_url + "/obtener_subcategoria/" + categoria_id;
                  $.get(url).done(function(data) {
                        $("#subcats").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              if (resultado.id === '{{(count($evento->subcategoria))?$evento->subcategoria->id:""}}') {
                                    elemento = "<option value=" + resultado.id + " selected >" + resultado.subcategoria + "</option>";
                              } else {
                                    elemento = "<option value=" + resultado.id + ">" + resultado.subcategoria + "</option>";
                              }
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

      function edit_map(event) {
            $('#latlng').val(event.latLng);
      }
</script>

<script>
      $('.clockpicker').clockpicker();

      $("#1").click(function() {
            sumar_fecha(30);
      });
      $("#2").click(function() {
            sumar_fecha(60);
      });
      $("#3").click(function() {
            sumar_fecha(90);
      });
      $("#gratis").click(function() {
            sumar_fecha(15);
      });
      function sumar_fecha(dias) {
            var day = moment($('#vig_ini').val(), "DD-MM-YYYY");
            day.add('days', dias);
            $('#vig_fin').val(day.format("DD-MM-YYYY"));
      }
</script>

<script>
      $(function() {
            $('.publicacion :input').attr('disabled', true);
      });

      $("#modificar_publicacion").click(function() {
            if ($('#modificar_publicacion').is(':checked')) {
                  $('.publicacion :input').attr('disabled', false);
            } else {
                  $('.publicacion :input').prop('disabled', true);
            }
      });

</script>

@stop