<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddActivacionToPromociones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promociones', function(Blueprint $table)
		{
			$table->boolean('is_activo');
			$table->date('fecha_nueva_activacion');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('promociones', function(Blueprint $table)
		{
			$table->dropColumn('is_activo');
			$table->dropColumn('fecha_nueva_activacion');
		});
	}

}
