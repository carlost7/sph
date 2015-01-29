<?php

/*
 * ***********************************
 * lista de eventos a escuchar para mandar llamar a las aplicaciones
 * ***********************************
 */

/*
 * Activa el contenido en la aplicacion, o envia un correo con el aviso del pago cancelado
 */
Event::listen('pago_aprobado', 'PagosListener@publicar_contenido');
Event::listen('pago_cancelado', 'PagosListener@avisar_cancelacion');

/*
 * Envia un codigo de pago gratuito al usuario
 */
Event::listen('enviar_codigo', 'CodigosListener@enviar_codigo');

/*
 * Envia un correo de bienvenida al usuario
 */
Event::listen('miembro.created', 'CorreosListener@enviar_correo_nuevo_usuario');

/*
 * Crea los pagos automaticos para el contenido
 */
Event::listen('negocio.created', 'PagosListener@store');
Event::listen('evento.created', 'PagosListener@store');
Event::listen('promocion.created', 'PagosListener@store');

/*
 * Modifica el pago para los eventos
*/
Event::listen('evento.modified','EventosListener@update');
