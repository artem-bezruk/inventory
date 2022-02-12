<?php
use Illuminate\Database\Seeder;
class CapacidadesSeeder extends Seeder
{
    public function run()
    {
        $capacidades = [1, 2, 4, 6, 8, 10, 16, 32, 64];
        foreach ($capacidades as $value) {
        	if ($value != 10) {
        		DB::table('capacidades')->insert([
        			'nomenclatura_id' => 2,
		        	'capacidad' => $value,
		        ]);
        	}
        	if ($value != 16 || $value != 32 || $value != 64) {
        		DB::table('capacidades')->insert([
        			'nomenclatura_id' => 3,
		        	'capacidad' => $value,
		        ]);
        	}
        }
    }
}
