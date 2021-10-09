<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ModulosSeeder extends Seeder
{
    public function run()
    {
        $modulos = [
        	'clases',
        	'sub_clases',
        	'categorias',
        	'sub_categorias',
        	'marcas',
        	'capacidades',
        	'estatus',
        	'generos',
        	'nomenclaturas',
        	'bitacora',
        	'modulos',
        	'roles',
        	'bienes',
        	'users',
        	'marcas_has_categorias',
        	'modulos_has_roles',
        ];
        foreach ($modulos as $value) {
        	DB::table('modulos')->insert([
        		'modulo' => $value
        	]);
        }
    }
}
