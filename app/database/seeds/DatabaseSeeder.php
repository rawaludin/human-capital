<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// disable query logging
		DB::connection()->disableQueryLog();
		Eloquent::unguard();

		$this->call('JobprefixesTableSeeder');
		$this->call('FunctionalscopesTableSeeder');
		$this->call('JobtitlesTableSeeder');
	}

}