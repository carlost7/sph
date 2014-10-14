@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Negocio</h2>

{{ Form::open(array('route'=>'clientes_negocios.store', 'files'=>true)) }}

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
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('estado','Estado') }}
                  {{ Form::select('estado', $estados->lists('estado','id'),null,array('class'=>'form-control','id'=>'estados')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('zona','Zona') }}
                  {{ Form::select('zona', array(),null,array('class'=>'form-control', 'id'=>'zonas')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('categoria','Categoria') }}
                  {{ Form::select('categoria', $categorias->lists('categoria','id'),null,array('class'=>'form-control','id'=>'categorias')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('subcategoria','subcategoria') }}
                  {{ Form::select('subcategoria', array(),null,array('class'=>'form-control', 'id'=>'subcats')) }}
            </div>
      </div>
</div>
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', Input::old('descripcion'), array('placeholder' => 'descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">      
      <div class="row">
            <div class="col-sm-6">
                  <div class="row">
                        <div class="col-sm-12">
                              {{ Form::label('horario','Horarios') }}
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('lun_ini','Lunes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="lun_ini" id="ini" value="{{ Input::old('lun_ini')}}">
                              </div>
                        </div>
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                              {{ Form::label('mar_ini','Martes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="mar_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                              {{ Form::label('mie_ini','Miercoles inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="mie_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('mie_fin','Miercoles fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="mie_fin" value="{{ Input::old('lun_ini')}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('jue_ini','Jueves inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="jue_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                              {{ Form::label('vie_ini','Viernes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="vie_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                              {{ Form::label('sab_ini','Sabado inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="sab_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                              
                        </div>
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                              {{ Form::label('dom_ini','Domingo inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control timeini" name="dom_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
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
            <div class="col-sm-6">
                  {{ Form::label('imagen','Imágen') }}
                  <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
                  <div id="imagepreview" class="imagepreview"></div>
                  {{ Form::label('alt','Descripción') }}
                  {{ Form::text('alt',Input::old('alt'),array('placeholder' => 'descripción', 'class'=>'form-control')) }}
            </div>
      </div>
</div>

<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("efectivo",1) }}            
                              ¿Reciben pago en efectivo?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox("tc",1) }} 
                              ¿Reciben tarjetas de credito?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("td",1) }}
                              ¿Reciben tarjetas de debito?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox("familiar",1) }}
                              ¿Es un espacio familiar?
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox("estacionamiento",1) }}                                               
                              ¿Cuenta con estacionamiento?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("valet_parking",1) }}            
                              ¿Cuenta con valet parking?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox("wifi",1) }}                 
                              ¿Cuenta con wifi?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("mascotas",1) }}            
                              ¿Se permiten mascotas?
                        </label>
                  </div>
            </div>

      </div>      
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
      {{ Form::label('mapa', 'Mapa') }}            
      {{ Form::hidden('mapa',Input::old('mapa'),array('id'=>'latlng')) }}
      @if($mapa)
      {{ $mapa['html'] }}      
      @endif
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

@if($mapa)
{{ $mapa['js'] }}
@endif

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
      $(document).ready(function() {
            $('#estados').change(function() {
                  var estado_id = $("#estados").val();
                  url = base_url + "/obtener_zona/" + estado_id;
                  $.get(url).done(function(data) {
                        $("#zonas").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              elemento = "<option value=" + resultado.id + ">" + resultado.zona + "</option>";
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

<script type="text/javascript">
      $('.clockpicker').clockpicker();
</script>

<script>
      $('#ini').focusout(function() {
            valor = $('#ini').val();

            $(".timeini").val(valor);
      });
      $('#fin').focusout(function() {
            valor = $('#fin').val();

            $(".timefin").val(valor);
      });
</script>
@stop