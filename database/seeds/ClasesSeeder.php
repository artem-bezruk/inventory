<?php
use Illuminate\Database\Seeder;
class ClasesSeeder extends Seeder
{
    public function run()
    {
    	$clases = [
    		'Computing',
    		'Networking',
    	];
        foreach ($clases as $value) {
        	DB::table('clases')->insert([
        		'clase' => $value
        	]);
        }
    }
}
