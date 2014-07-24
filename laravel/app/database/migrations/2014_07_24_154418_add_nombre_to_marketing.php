<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNombreToMarketing extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('marketings', function(Blueprint $table)
		{
			$table->string('nombre');
                  $table->boolean('is_activo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('marketings', function(Blueprint $table)
		{
			$table->dropColumn('nombre');
		});
	}

}
