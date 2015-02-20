<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAltToEventosImagenes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos_imagenes', function(Blueprint $table)
		{
			$table->string('alt')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos_imagenes', function(Blueprint $table)
		{
			$table->dropColumn('alt');
		});
	}

}
