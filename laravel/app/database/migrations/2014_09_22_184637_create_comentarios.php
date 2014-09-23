<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComentarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usuario_id');
                  $table->foreign('usuario_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
			$table->text('comentario');
			$table->text('comentable_type');
			$table->integer('comentable_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comentarios');
	}

}
