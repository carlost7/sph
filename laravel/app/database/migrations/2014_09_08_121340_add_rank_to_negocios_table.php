<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRankToNegociosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('negocios', function(Blueprint $table)
		{
			$table->renameColumn('likes', 'rank');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('negocios', function(Blueprint $table)
		{
			$table->renameColumn('rank', 'likes');
		});
	}

}
