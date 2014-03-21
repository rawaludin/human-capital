<?php

class FunctionalscopesTableSeeder extends Seeder {

	public function run()
	{
	    // wipe table
        DB::table('jobtitles')->delete();
        DB::table('functionalscopes')->delete();
        // create record
        $functionalscopes = array(
            array('id'=>1,'code'=>'FS01', 'title'=>'President'),
            array('id'=>2,'code'=>'FS02', 'title'=>'Operational'),
            array('id'=>3,'code'=>'FS03', 'title'=>'Finance & IT')
        );
        // insert record
        DB::table('functionalscopes')->insert($functionalscopes);
	}

}