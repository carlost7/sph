<div class="show_comentario list-group-item" id="com-{{ $comentario->id }}">
      <div class="comentario" id="show-com-{{$comentario->id}}">
            <p>{{ $comentario->usuario->email }}</p>
            <p>{{ $comentario->comentario }}</p>

            @if(Auth::check())

            @if(Auth::user()->id == $comentario->usuario->id)
            <p class="text-right">
                  {{ Form::button('editar',array('class'=>'btn btn-sm btn-info','onclick'=>'show_edit_comment('.$comentario->id.')')) }}
            </p>
            {{ Form::open(array('route' => array('comentarios.destroy',$comentario->id),'id'=>'del_comentario-'.$comentario->id)) }}
            {{ Form::hidden('_method', 'DELETE') }}            
            <p class="text-right">{{ Form::button('eliminar', array('class' => 'btn btn-sm btn-danger','onclick'=>'delete_comment('.$comentario->id.')')) }} </p>
            {{ Form::close() }}                        
            @endif

            @endif


      </div>

      @if(Auth::check())

      @if(Auth::user()->id == $comentario->usuario->id)

      <div class="edit_comentario" id="edit-com-{{$comentario->id}}">
            {{ Form::model($comentario, array('route' => array('comentarios.update', $comentario->id), 'method' => 'PUT','id'=>"frm-com-".$comentario->id)) }}
            {{ Form::textArea('comentario', $comentario->comentario, array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'comentario')) }}                  
            {{ Form::button('editar', array('class' => 'btn btn-sm btn-primary','onclick'=>'submit_edit_form('.$comentario->id.')')) }}                  
            {{ Form::button('cancelar', array('class' => 'btn btn-sm btn-primary','onclick'=>'hide_edit_comment('.$comentario->id.')')) }}

            {{ Form::close() }}
      </div>

      @endif

      @endif

</div>