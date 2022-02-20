<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AccionesSeeder extends Seeder
{
    public function run()
    {
    	$acciones = (object) [
    		'Create',
    		'Update',
    		'Delete',
    		'Login',
    		'Logout',
    	];
        foreach ($acciones as $value) {
        	DB::table('acciones')->insert([
        		'accion' => $value
        	]);
        }
    }
}
