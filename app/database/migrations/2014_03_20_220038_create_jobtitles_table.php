<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobtitlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobtitles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code')->unique();
			$table->string('title')->unique();
			$table->integer('jobprefix_id')->unsigned();
			$table->integer('functionalscope_id')->unsigned();
			$table->boolean('status');
			$table->foreign('functionalscope_id')->references('id')->on('functionalscopes')
				  ->onUpdate('cascade')->onDelete('restrict');
			$table->foreign('jobprefix_id')->references('id')->on('jobprefixes')
				  ->onUpdate('cascade')->onDelete('restrict');
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
		Schema::drop('jobtitles');
	}

}
