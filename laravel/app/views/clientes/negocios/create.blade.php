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
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', Input::old('descripcion'), array('placeholder' => 'descripcion', 'class'=>'form-control')) }}
</div>


<div class="form-group">
      {{ Form::label('llevar','Más información') }}
      <div class="row">
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('domicilio',1) }}            
                              ¿Entregan a domicilio?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox('llevar',1) }}                       
                              ¿Servicio para llevar?
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox('familiar',1) }}                       
                              ¿Ambiente familiar?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('alcohol',1) }}            
                              ¿Cuenta con alcohol?
                        </label>
                  </div>
            </div>

      </div>      
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-4">
                  {{ Form::label('moneda','Moneda') }}
                  {{ Form::select('moneda', array('MEX' => 'Pesos', 'USD' => 'Dolares'),null,array('class'=>'form-control')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('rango_min','Rango de precios mínimo') }}
                  {{ Form::text('rango_min', Input::old('rango_min'), array('placeholder' => '00.00', 'class'=>'form-control')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('rango_max','Rango de precios máximo') }}
                  {{ Form::text('rango_max', Input::old('rango_max'), array('placeholder' => '00.00', 'class'=>'form-control')) }}
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
                              {{ Form::checkbox('tc', true) }}      
                              Tarjeta de crédito
                        </label>
                  </div>

            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('td', true) }}      
                              Tarjeta de debito
                        </label>
                  </div>
            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('efectivo', true) }}
                              Efectivo
                        </label>                        
                  </div>
            </div>
      </div>
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
                                    <input type="text" class="form-control" name="lun_ini" value="{{ Input::old('lun_ini')}}">
                              </div>
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('lun_fin','Lunes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="lun_fin" value="{{ Input::old('lun_ini')}}">
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
                                    <input type="text" class="form-control" name="mar_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('mar_fin','Martes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="mar_fin" value="{{ Input::old('lun_ini')}}">
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
                                    <input type="text" class="form-control" name="mie_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('mie_fin','Miercoles fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="mie_fin" value="{{ Input::old('lun_ini')}}">
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
                                    <input type="text" class="form-control" name="jue_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('jue_fin','Jueves fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="jue_fin" value="{{ Input::old('lun_ini')}}">
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
                                    <input type="text" class="form-control" name="vie_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('vie_fin','Viernes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="vie_fin" value="{{ Input::old('lun_ini')}}">
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
                                    <input type="text" class="form-control" name="sab_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                              
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('sab_fin','Sabado fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="sab_fin" value="{{ Input::old('lun_ini')}}">
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
                                    <input type="text" class="form-control" name="dom_ini" value="{{ Input::old('lun_ini')}}">
                              </div>                             
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('dom_fin','Domingo fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="dom_fin" value="{{ Input::old('lun_ini')}}">
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



@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Crear negocio</button>
</div>        

{{ Form::close() }}

@stop

@section('scripts')
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}
{{ HTML::script('js/vendor/bootstrap-clockpicker.min.js') }}

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

<script type="text/javascript">
      $('.clockpicker').clockpicker();
</script>
@stop