<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteUsuarioFromComentarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comentarios', function($table)
            {
                  $table->dropColumn('usuario_id')->unsigned();                  
                  $table->dropForeign('comentarios_usuario_id_foreign');
            });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comentarios', function($table)
            {     
                  $table->integer('usuario_id')->unsigned();                  
                  $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            });
	}

}
