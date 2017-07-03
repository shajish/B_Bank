<?php

use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		  //delete users table records
    	DB::table('blood_groups')->delete();

    	DB::table('blood_groups')->insert([
    		['name' => 'A +'],
    		['name' => 'A -'],
    		['name' => 'B +'],
    		['name' => 'B -'],
    		['name' => 'AB +'],
    		['name' => 'AB -'],
    		['name' => 'O +'],
    		['name' => 'O -'],
    		]);
    }
}
