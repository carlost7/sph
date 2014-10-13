<div class="show_comentario list-group-item" id="com-{{ $comentario->id }}">
      <p>{{ $comentario->usuario->email }}</p>
      
      <div id="funct-{{$comentario->id}}">
            
      <p>{{ $comentario->comentario }}</p>

      @if(Auth::check())
      <p class="text-right">
            {{ Form::button('comentar',array('class'=>'btn btn-sm btn-primary','onclick'=>'show_response('.$comentario->id.')')) }}
      </p>
      
      @if(Auth::user()->id == $comentario->usuario->id)
            <p class="text-right">
                  {{ Form::button('editar',array('class'=>'btn btn-sm btn-info','onclick'=>'show_edit_comment('.$comentario->id.')')) }}
            </p>
            {{ Form::open(array('route' => array('clientes_comentarios.destroy',$comentario->id),'id'=>'del_comentario-'.$comentario->id)) }}
            {{ Form::hidden('_method', 'DELETE') }}            
            <p class="text-right">{{ Form::button('eliminar', array('class' => 'btn btn-sm btn-danger','onclick'=>'delete_comment('.$comentario->id.')')) }} </p>
            {{ Form::close() }}                        
      @endif
      
      @endif            
      </div>

      
      

      @if(Auth::check())
      <!-- Agregar Respuesta al comentario -->
      <div class="add_comentario list-group-item" id='add-com-{{$comentario->id}}'>
            {{ Form::open(array('route' => array('clientes_comentarios.store','id'=>$comentario->id,'clase'=>get_class($comentario)),'id'=>$comentario->id)) }}
            {{ Form::label('comentario','Responder comentario') }}
            {{ Form::textArea('comentario', Input::old('comentario'), array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'text-com'.$comentario->id)) }}
            {{ Form::button('agregar', array('class' => 'btn btn-sm btn-primary','onclick'=>'add_comment('.$comentario->id.')','id'=>"add-com-".$comentario->id)) }}
            {{ Form::button('cancelar', array('class' => 'btn btn-sm btn-primary','onclick'=>'hide_response('.$comentario->id.')')) }}
            {{ Form::close() }}                        
      </div> 
      
      @if(Auth::user()->id == $comentario->usuario->id)

      <div class="edit_comentario" id="edit-com-{{$comentario->id}}">
            {{ Form::model($comentario, array('route' => array('clientes_comentarios.update', $comentario->id), 'method' => 'PUT','id'=>"edit-frm-".$comentario->id)) }}
            {{ Form::textArea('comentario', $comentario->comentario, array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'comentario')) }}                  
            {{ Form::button('editar', array('class' => 'btn btn-sm btn-primary','onclick'=>'submit_edit_form('.$comentario->id.')')) }}                  
            {{ Form::button('cancelar', array('class' => 'btn btn-sm btn-primary','onclick'=>'hide_edit_comment('.$comentario->id.')')) }}

            {{ Form::close() }}
      </div>

      @endif
      
      @endif

      @if(count($comentario->comentarios))
      @foreach($comentario->comentarios as $comentario)
      @include('layouts.show_comentario',array('comentario',$comentario))
      @endforeach
      @endif
</div>      
