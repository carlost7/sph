<div class="show_comentario list-group-item" id="com-{{ $comentario->id }}">
      <div class="nombre">
            {{ $comentario->usuario->correo }}                  
      </div>
      <div class="comentario">
            {{ $comentario->comentario }}
      </div>
      <div class="formulario">
            <p class="text-right">
                  {{ HTML::linkRoute('comentarios.edit','editar',$comentario->id,array('class'=>'btn btn-sm btn-info')) }}       
            </p>

            {{ Form::open(array('route' => array('comentarios.destroy',$comentario->id),'id'=>'del_comentario-'.$comentario->id)) }}
            {{ Form::hidden('_method', 'DELETE') }}            
            <p class="text-right">{{ Form::button('eliminar', array('class' => 'btn btn-sm btn-danger','onclick'=>'delete_comment('.$comentario->id.')')) }} </p>
            {{ Form::close() }}                        
      </div>
</div>