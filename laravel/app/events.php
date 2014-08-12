<?php

/*
 * ***********************************
 * lista de eventos a escuchar para mandar llamar a las aplicaciones
 * ***********************************
 */

Event::listen('pago_aprobado', 'PagosListener@publicar_contenido');

Event::listen('pago_cancelado', 'PagosListener@avisar_cancelacion');