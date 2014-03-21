<?php

class JobtitlesTableSeeder extends Seeder {

	public function run()
	{
    // wipe table
        DB::table('jobtitles')->delete();
        // create record
        $jobtitles = array(
            array('id'=>1, 'jobprefix_id'=>'1','functionalscope_id'=>'1', 'code'=>'JT01', 'title'=>'Director President', 'status'=>'1'),
            array('id'=>2, 'jobprefix_id'=>'1','functionalscope_id'=>'2', 'code'=>'JT02', 'title'=>'Director Operational', 'status'=>'0'),
            array('id'=>3, 'jobprefix_id'=>'1','functionalscope_id'=>'3', 'code'=>'JT03', 'title'=>'Director IT', 'status'=>'1')
        );
        // insert record
        DB::table('jobtitles')->insert($jobtitles);
	}

}