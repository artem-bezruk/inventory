<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
        	(object) [
        		'rol' => 'Administrador',
        		'descripcion' => 'Administrador',
        		'prioridad' => 0
        	],
        	(object) [
        		'rol' => 'Encargado',
        		'descripcion' => 'Persona a cargo del almacen',
        		'prioridad' => 1
        	],
        	(object) [
        		'rol' => 'Operador',
        		'descripcion' => 'Persona encargada de ejecutar las tareas en el almacen',
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
