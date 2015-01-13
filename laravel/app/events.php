<?php

/*
 * ***********************************
 * lista de eventos a escuchar para mandar llamar a las aplicaciones
 * ***********************************
 */

Event::listen('pago_aprobado', 'PagosListener@publicar_contenido');

Event::listen('pago_cancelado', 'PagosListener@avisar_cancelacion');

Event::listen('enviar_codigo', 'CodigosListener@enviar_codigo');

Event::listen('nuevo_usuario_correo', 'CorreosListener@enviar_correo_nuevo_usuario');

Event::listen('negocio.created', 'PagosListener@store');
Event::listen('evento.created', 'PagosListener@store');
Event::listen('promocion.created', 'PagosListener@store');

Event::listen('evento.updated', 'PagosListener@update');
