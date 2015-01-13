<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterHorariosNegocioTable extends Migration
{

      /**
       * Run the migrations.
       * Cambiael estatement con el prefijo para subir los cambios a base de datos
       * @return void
       */
      public function up()
      {
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `lun_ini` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `mar_ini` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `mie_ini` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `jue_ini` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `vie_ini` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `sab_ini` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `dom_ini` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `lun_fin` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `mar_fin` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `mie_fin` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `jue_fin` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `vie_fin` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `sab_fin` time NULL;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `dom_fin` time NULL;');            
            
            DB::statement('UPDATE app_horarios_negocio SET `lun_ini` = NULL WHERE `lun_ini` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `mar_ini` = NULL WHERE `mar_ini` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `mie_ini` = NULL WHERE `mie_ini` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `jue_ini` = NULL WHERE `jue_ini` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `vie_ini` = NULL WHERE `vie_ini` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `sab_ini` = NULL WHERE `sab_ini` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `dom_ini` = NULL WHERE `dom_ini` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `lun_fin` = NULL WHERE `lun_fin` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `mar_fin` = NULL WHERE `mar_fin` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `mie_fin` = NULL WHERE `mie_fin` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `jue_fin` = NULL WHERE `jue_fin` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `vie_fin` = NULL WHERE `vie_fin` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `sab_fin` = NULL WHERE `sab_fin` = 0;');
            DB::statement('UPDATE app_horarios_negocio SET `dom_fin` = NULL WHERE `dom_fin` = 0;');            
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            DB::statement('UPDATE app_horarios_negocio SET `lun_ini` = 0 WHERE `lun_ini` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `mar_ini` = 0 WHERE `mar_ini` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `mie_ini` = 0 WHERE `mie_ini` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `jue_ini` = 0 WHERE `jue_ini` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `vie_ini` = 0 WHERE `vie_ini` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `sab_ini` = 0 WHERE `sab_ini` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `dom_ini` = 0 WHERE `dom_ini` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `lun_fin` = 0 WHERE `lun_fin` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `mar_fin` = 0 WHERE `mar_fin` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `mie_fin` = 0 WHERE `mie_fin` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `jue_fin` = 0 WHERE `jue_fin` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `vie_fin` = 0 WHERE `vie_fin` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `sab_fin` = 0 WHERE `sab_fin` = null;');
            DB::statement('UPDATE app_horarios_negocio SET `dom_fin` = 0 WHERE `dom_fin` = null;');   
            
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `lun_ini` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `mar_ini` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `mie_ini` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `jue_ini` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `vie_ini` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `sab_ini` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `dom_ini` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `lun_fin` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `mar_fin` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `mie_fin` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `jue_fin` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `vie_fin` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `sab_fin` time;');
            DB::statement('ALTER TABLE `app_horarios_negocio` MODIFY `dom_fin` time;');
            
      }

}
