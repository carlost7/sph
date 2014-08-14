<?php

/*
 * Modelo en donde se guardaran los horarios del negocio
 */

class HorarioNegocio extends \Eloquent
{
      protected $table = 'horarios_negocio';
      
      protected $fillable = ['lun_ini','mar_ini','mie_ini','jue_ini','vie_ini','sab_ini','dom_ini','lun_fin','mar_fin','mie_fin','jue_fin','vie_fin','sab_fin','dom_fin'];

      /*
       * Un horario le pertence a un negocio
       */
      public function negocio(){
            return $this->belongsTo('Negocio');
      }
      
}
