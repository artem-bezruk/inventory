<?php
use Illuminate\Database\Seeder;
class SubclasesSeeder extends Seeder
{
    public function run()
    {
        $computacion = [
        	"Components",
        	"Accessories",
        	"Computers",
        ];
        $redes = [
        	"Networking and Wireless",
        ];
        foreach ($computacion as $value) {
        	DB::table('sub_clases')->insert([
        		'clase_id' => 1,
	            'sub_clase' => $value,
	        ]);
        }
		foreach ($redes as $value) {
	    	DB::table('sub_clases')->insert([
	    		'clase_id' => 2,
	            'sub_clase' => $value,
	        ]);
	    }
    }
}
