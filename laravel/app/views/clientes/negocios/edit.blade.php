@extends('layouts.client_dashboard_master')

@section('content')

@if($negocio)
<h2>Editar: {{ $negocio->nombre }}</h2>

{{ Form::model($negocio, array('route' => array('clientes_negocios.update', $negocio->id), 'method' => 'PUT','files'=>true)) }}

<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', $negocio->direccion, array('placeholder' => 'dirección', 'class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', $negocio->telefono, array('placeholder' => 'telefono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', $negocio->descripcion, array('placeholder' => 'Descripcion', 'class'=>'form-control')) }}
</div>
@if(count($negocio->masInfo))
<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("efectivo",true,$negocio->masInfo->efectivo) }}            
                              ¿Reciben pago en efectivo?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox("tc",true,$negocio->masInfo->tc) }} 
                              ¿Reciben tarjetas de credito?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("td",true,$negocio->masInfo->td) }}
                              ¿Reciben tarjetas de debito?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox("familiar",true,$negocio->masInfo->familiar) }}
                              ¿Es un espacio familiar?
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox("estacionamiento",true,$negocio->masInfo->estacionamiento) }}                                               
                              ¿Cuenta con estacionamiento?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("valet_parking",true,$negocio->masInfo->valet_parking) }}            
                              ¿Cuenta con valet parking?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox("wifi",true,$negocio->masInfo->wifi) }}                 
                              ¿Cuenta con wifi?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox("mascotas",true,$negocio->masInfo->mascotas) }}            
                              ¿Se permiten mascotas?
                        </label>
                  </div>
            </div>

      </div>      
</div>
@endif
<div class="form-group">      
      <div class="row">
            <div class="col-sm-12">
                  <div class="row">
                        <div class="col-sm-12">
                              {{ Form::label('horario','Horarios') }}
                        </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("lun",1,($negocio->horario->lun_ini == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'lun')) }}
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
                                    <input type="text" class="form-control" name="lun_ini" value="{{ date('H:i',strtotime($negocio->horario->lun_ini))}}">
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('lun_fin','Lunes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="lun_fin" value="{{ date('H:i',strtotime($negocio->horario->lun_fin))}}">
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
                                          {{ Form::checkbox("mar",1,($negocio->horario->mar_ini == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'mar')) }}
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
                                    <input type="text" class="form-control" name="mar_ini" value="{{ date('H:i',strtotime($negocio->horario->lun_ini))}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mar_fin','Martes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="mar_fin" value="{{ date('H:i',strtotime($negocio->horario->mar_fin))}}">
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
                                          {{ Form::checkbox("mie",1,(($negocio->horario->mie_ini == "00:00:00"))?true:false,array('class'=>'desactivar','id'=>'mie')) }}
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
                                    <input type="text" class="form-control" name="mie_ini" value="{{ date('H:i',strtotime($negocio->horario->mie_ini))}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mie_fin','Miercoles fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="mie_fin" value="{{ date('H:i',strtotime($negocio->horario->mie_fin))}}">
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
                                          {{ Form::checkbox("jue",1,($negocio->horario->jue_ini == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'jue')) }}
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
                                    <input type="text" class="form-control" name="jue_ini" value="{{ date('H:i',strtotime($negocio->horario->jue_ini))}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('jue_fin','Jueves fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="jue_fin" value="{{ date('H:i',strtotime($negocio->horario->jue_fin))}}">
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
                                          {{ Form::checkbox("vie",1,($negocio->horario->vie_ini == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'vie')) }}
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
                                    <input type="text" class="form-control" name="vie_ini" value="{{ date('H:i',strtotime($negocio->horario->vie_ini))}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('vie_fin','Viernes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="vie_fin" value="{{ date('H:i',strtotime($negocio->horario->vie_fin))}}">
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
                                          {{ Form::checkbox("sab",1,($negocio->horario->sab_ini == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'sab')) }}
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
                                    <input type="text" class="form-control" name="sab_ini" value="{{ date('H:i',strtotime($negocio->horario->sab_ini))}}">
                              </div>                              
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('sab_fin','Sabado fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="sab_fin" value="{{ date('H:i',strtotime($negocio->horario->sab_fin))}}">
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
                                          {{ Form::checkbox("dom",1,($negocio->horario->dom_ini == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'dom')) }}
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
                                    <input type="text" class="form-control" name="dom_ini" value="{{ date('H:i',strtotime($negocio->horario->dom_ini))}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('dom_fin','Domingo fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="dom_fin" value="{{ date('H:i',strtotime($negocio->horario->dom_fin))}}">
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
            <div class="col-sm-12">
                  {{ Form::label('imagen','Imágen') }}
                  <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
                  
                  @if($negocio->imagen)
                  <div id="imagepreview" class="imagepreview" style="background-image: url({{ Config::get('params.path_serve_image_transform').Image::path($negocio->imagen->path.$negocio->imagen->nombre,'resizeCrop',250,250,'left','top') }})"></div>
                  {{ Form::label('alt','Descripción') }}
                  {{ Form::text('alt',$negocio->imagen->alt,array('placeholder' => 'descripción', 'class'=>'form-control')) }}
                  @else
                  <div id="imagepreview" class="imagepreview"></div>
                  {{ Form::label('alt','Descripción') }}
                  {{ Form::text('alt',null,array('placeholder' => 'descripción', 'class'=>'form-control')) }}
                  @endif


            </div>
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-4">
                  {{ Form::label('estado','Estado') }}
                  {{ Form::select('estado', $estados->lists('estado','id'),$negocio->estado->id,array('class'=>'form-control','id'=>'estados')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('zona','Zona') }}
                  {{ Form::select('zona', array(),(count($negocio->zona))?$negocio->zona->id:null,array('class'=>'form-control', 'id'=>'zonas')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-4">
                  {{ Form::label('categoria','Categoria') }}
                  {{ Form::select('categoria', $categorias->lists('categoria','id'),$negocio->categoria->id,array('class'=>'form-control','id'=>'categorias')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('subcategoria','subcategoria') }}
                  {{ Form::select('subcategoria', array(),(count($negocio->subcategoria))?$negocio->subcategoria->id:null,array('class'=>'form-control', 'id'=>'subcats')) }}
            </div>
      </div>

</div>
<div class="form-group">
      {{ Form::label('webpage', 'Página web') }}            
      {{ Form::text('webpage', ($negocio->especial) ? $negocio->especial->webpage : '' ,array('placeholder'=>'página web','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico') }}            
      {{ Form::text('email', ($negocio->especial) ? $negocio->especial->email : '' ,array('placeholder'=>'correo electrónico','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('mapa', 'Mapa') }}            
      {{ Form::hidden('mapa',($negocio->especial) ? $negocio->especial->mapa : '',array('id'=>'latlng')) }}
      @if($mapa)
      {{ $mapa['html'] }}      
      @endif
</div>        
<div class="form-group">
      <div class="checkbox">
            <label>
                  {{ Form::checkbox('add_images', true) }}      
                  agregar o editar imagenes especiales
            </label>
      </div>
</div>

@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar negocio</button>
</div>        



{{ Form::close() }}


@else
<h2>No seleccionó ningún evento para editar</h2>

@endif


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
                              if(resultado.id == {{(count($negocio->zona))?$negocio->zona->id:''}}){
                                    elemento = "<option value=" + resultado.id + " selected >" + resultado.zona + "</option>";
                              }else{
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
                              if(resultado.id == {{(count($negocio->subcategoria))?$negocio->subcategoria->id:''}}){
                                    elemento = "<option value=" + resultado.id + " selected >" + resultado.subcategoria + "</option>";
                              }else{
                                    elemento = "<option value=" + resultado.id + ">" + resultado.subcategoria + "</option>";
                              }
                              $("#subcats").append(elemento);
                        }
                  });
            }).trigger('change');
      });
     
</script>

<script>
      function save_map(event){
            $('#latlng').val(event.latLng);
            createMarker_map({ map: map, position:event.latLng });
      }
      
      function edit_map(event){  
            $('#latlng').val(event.latLng);            
      }
</script>

<script>
      $('.clockpicker').clockpicker();
      
      
      $(".desactivar").click(function(e) {
            var dia = $(this).attr('id');
            if ($(this).prop('checked')) {
                  $("input[name="+dia+"_ini]").prop('disabled',true);
                  $("input[name="+dia+"_fin]").prop('disabled',true);
            }else{
                  $("input[name="+dia+"_ini]").prop('disabled',false);
                  $("input[name="+dia+"_fin]").prop('disabled',false);
            }

      });
      
      $(document).ready(function(){
            
            $(".desactivar").each(function(i){
                  var dia = $(this).attr('id');
                  if ($(this).prop('checked')) {
                        $("input[name="+dia+"_ini]").prop('disabled',true);
                        $("input[name="+dia+"_fin]").prop('disabled',true);
                  }else{
                        $("input[name="+dia+"_ini]").prop('disabled',false);
                        $("input[name="+dia+"_fin]").prop('disabled',false);
                  }
            });            
      });
      
</script>


@stop