<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('listes', function(Blueprint $table)
		{
			$table->increments('id')->unique();
			$table->integer('user_id');
			$table->string('nomliste');
			$table->string('description');
			$table->boolean('done');
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
		Schema::drop('taches');
	}

}
