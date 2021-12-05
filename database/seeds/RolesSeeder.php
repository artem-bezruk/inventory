<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
        	(object) [
        		'rol' => 'Administrator',
        		'descripcion' => 'Person to charge of System',
        		'prioridad' => 0
        	],
        	(object) [
        		'rol' => 'Attendant',
        		'descripcion' => 'Person to charge of Warehouse',
        		'prioridad' => 1
        	],
        	(object) [
        		'rol' => 'Operator',
        		'descripcion' => 'Person in charge to execute the tasks on the Warehouse',
        		'prioridad' => 2
        	],
        ];
        foreach ($roles as $key => $value) {
        	DB::table('roles')->insert([
        		'rol' => $value->rol,
        		'descripcion' => $value->descripcion,
        		'prioridad' => $value->prioridad
        	]);
        }
    }
}
