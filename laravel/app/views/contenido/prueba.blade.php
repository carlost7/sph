<?php $negocio = Negocio::find(1004); ?>
<img src="{{ URL::to('/').Image::path(Config::get("params.usrimg").$negocio->imagen->path.$negocio->imagen->nombre,'resize',250,250,1) }}" >