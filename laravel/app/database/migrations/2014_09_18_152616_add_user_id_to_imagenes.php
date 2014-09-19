<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserIdToImagenes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('imagenes', function(Blueprint $table)
		{
                  $table->dropForeign('imagenes_cliente_id_foreign');
                  $table->dropColumn('cliente_id');                  
			$table->integer('user_id')->unsigned();
                  $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('imagenes', function(Blueprint $table)
		{
                  $table->dropForeign('imagenes_user_id_foreign');
			$table->dropColumn('user_id');
                  $table->integer('cliente_id')->unsigned();
                  $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
		});
	}

}
