<div class="show_comentario list-group-item" id="com-{{ $comentario->id }}">
      <p>{{ $comentario->usuario->email }}</p>
      <p>{{ $comentario->comentario }}</p>

      @if(Auth::check())
      <p class="text-right">
            {{ Form::button('comentar',array('class'=>'btn btn-sm btn-primary','onclick'=>'show_response('.$comentario->id.')')) }}
      </p>
      @endif


      @if(Auth::check())
      <!-- Agregar Respuesta al comentario -->
      <div class="add_comentario list-group-item" id='add-com-{{$comentario->id}}'>
            {{ Form::open(array('route' => array('comentarios.store','id'=>$comentario->id,'clase'=>get_class($comentario)),'class'=>'frm_add_response','id'=>$comentario->id)) }}
            {{ Form::label('comentario','Responder comentario') }}
            {{ Form::textArea('comentario', Input::old('comentario'), array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'text-com'.$comentario->id)) }}
            {{ Form::submit('agregar', array('class' => 'btn btn-sm btn-primary')) }}
            {{ Form::button('cancelar', array('class' => 'btn btn-sm btn-primary','onclick'=>'hide_response('.$comentario->id.')')) }}
            {{ Form::close() }}                        
      </div> 
      @endif

      @if(count($comentario->comentarios))
      @foreach($comentario->comentarios as $comentario)
      @include('layouts.show_comentario',array('comentario',$comentario))
      @endforeach
      @endif
</div>      
