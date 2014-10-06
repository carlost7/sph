<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUsuarioIdToComentarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comentarios', function(Blueprint $table)
		{
			$table->integer('usuario_id')->unsigned();
                  $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comentarios', function(Blueprint $table)
		{
			$table->dropForeign('comentarios_usuario_id_foreign');
			$table->dropColumn('usuario_id');
		});
	}

}
