<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ModulosSeeder extends Seeder
{
    public function run()
    {
        $modulos = [
        	['clases', 1],
        	['sub_clases', 1],
        	['categorias', 1],
        	['sub_categorias', 1],
        	['marcas', 1],
        	['capacidades', 1],
        	['estatus', 1],
        	['generos', 1],
        	['nomenclaturas', 1],
        	['bitacora', 0],
        	['modulos', 1],
        	['roles', 1],
        	['bienes', 1],
        	['users', 1],
            ['users_perfil', 0],
        	['marcas_has_categorias', 1],
        	['modulos_has_roles', 1],
            ['configuraciones', 0],
        ];
        foreach ($modulos as $value) {
        	DB::table('modulos')->insert([
        		'modulo' => $value[0],
                'filtrable' => $value[1]
        	]);
        }
    }
}
