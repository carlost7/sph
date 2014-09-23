<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFechasToPromociones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promociones', function(Blueprint $table)
		{
			$table->date('publicacion_inicio');
			$table->date('publicacion_fin');
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
			$table->dropColumn('publicacion_inicio');
			$table->dropColumn('publicacion_fin');
		});
	}

}
