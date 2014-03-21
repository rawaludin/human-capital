<?php

class JobprefixesTableSeeder extends Seeder {

	public function run()
	{
        // wipe table
        DB::table('jobtitles')->delete();
		DB::table('jobprefixes')->delete();
        // create record
        $jobprefixes = array(
            array('id'=>1,'code'=>'JP01', 'title'=>'Director'),
            array('id'=>2,'code'=>'JP02', 'title'=>'Secretary'),
            array('id'=>3,'code'=>'JP03', 'title'=>'Senior Manager')
        );
        // insert record
        DB::table('jobprefixes')->insert($jobprefixes);
	}

}