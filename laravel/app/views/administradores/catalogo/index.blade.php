@extends('layouts.admin_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('administrador_catalogo.create','Agregar datos') }}</li>            
      </ul>      
</div>

<div class="container">
      <div class="row">
            <div class="col-sm-6">
                  <h4>Categorías</h4>
                  <div class="listas">                        
                        <div class="list-group">
                              @foreach($categorias as $categoria)
                              <div class="list-group-item" onclick="show_subs({{$categoria->id}})">
                                    {{ $categoria->categoria }} 
                                    {{ HTML::linkRoute('administrador_catalogo.edit','editar',array('id'=>$categoria->id,'tipo'=>get_class($categoria)),array('class'=>'btn btn-sm')) }} 
                                    {{ Form::open(array('route' => array('administrador_catalogo.destroy','id'=>$categoria->id,'tipo'=>get_class($categoria)))) }}            
                                    {{ Form::hidden('_method', 'DELETE') }}            
                                    <p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-sm btn-link')) }} </p>
                                    {{ Form::close() }}                        
                              </div>
                              @endforeach                               
                        </div>
                  </div>

            </div>
            <div class="col-sm-6">
                  <h4>Subcategorias</h4>
                  <div class="listas">
                        <div class="list-group" id='subcats'>
                        </div>
                  </div>                  
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  <h4>Estados</h4>
                  <div class="listas">
                        <div class="list-group">
                              @foreach($estados as $estado)
                              <div class="list-group-item" onclick="show_zonas({{$estado->id}})">
                                    {{ $estado->estado }}
                                    {{ HTML::linkRoute('administrador_catalogo.edit','editar',array('id'=>$estado->id,'tipo'=>get_class($estado)),array('class'=>'btn btn-sm')) }}
                                    {{ Form::open(array('route' => array('administrador_catalogo.destroy','id'=>$estado->id,'tipo'=>get_class($estado)))) }}            
                                    {{ Form::hidden('_method', 'DELETE') }}            
                                    <p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-sm btn-link')) }} </p>
                                    {{ Form::close() }}                        
                              </div>
                              @endforeach
                        </div>
                  </div>                  


            </div>
            <div class="col-sm-6">                  
                  <h4>Zonas</h4>
                  <div class="listas">
                        <div class="list-group" id='zonas'>                              
                        </div>
                  </div>                  
            </div>
      </div>

</div>

@stop

@section('scripts')
<script>
              function show_subs(id){
              url = base_url + "/obtener_subcategoria/" + id;
                      $.get(url).done(function(data){
              if (data.length == 0){
              $("#subcats").empty();
                      $("#subcats").append("<div class='list-group-item'>No hay subcategorias</div>");
              } else{
              $("#subcats").empty();
                      for (i = 0; i < data.length; i++){
              resultado = data[i];
                      elemento = "<div class='list-group-item'>" + resultado.subcategoria + "<a href='" + base_url + "/administrador_catalogo/" + resultado.id + "/edit?tipo=Subcategoria' class='btn btn-sm'>editar</a>" +
                              "<form method='POST' action='"+base_url+"/administrador_catalogo/"+resultado.id+"?tipo=Subcategoria' accept-charset='UTF-8'>"+
                              "<input name='_method' type='hidden' value='DELETE'> " +
                              "<p class='text-right'><input class='btn btn-sm btn-link' type='submit' value='eliminar'></p>" +
                              "</form></div>";                               
                      $("#subcats").append(elemento);
              }
              }

              });
              };
              function show_zonas(id){
              url = base_url + "/obtener_zona/" + id;
                      $.get(url).done(function(data){
              if (data.length == 0){
              $("#zonas").empty();
                      $("#zonas").append("<div class='list-group-item'>No hay zonas</div>");
              } else{
              $("#zonas").empty();
                      for (i = 0; i < data.length; i++){
              resultado = data[i];
                      elemento = "<div class='list-group-item'>" + resultado.zona + "<a href='" + base_url + "/administrador_catalogo/" + resultado.id + "/edit?tipo=Zona' class='btn btn-sm'>editar</a>" +
                              "<form method='POST' action='"+base_url+"/administrador_catalogo/"+resultado.id+"?tipo=Zona' accept-charset='UTF-8'>"+
                              "<input name='_method' type='hidden' value='DELETE'> " +
                              "<p class='text-right'><input class='btn btn-sm btn-link' type='submit' value='eliminar'></p>" +
                              "</form></div>";
                      $("#zonas").append(elemento);
              }
              }

              });
              };

</script>


@stop