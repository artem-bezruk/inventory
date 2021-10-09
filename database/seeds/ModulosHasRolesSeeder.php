<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ModulosHasRolesSeeder extends Seeder
{
    public function run()
    {
    	$roles = [
    		1,
    		2,
    		3,
    	];
    	$modulos = [
    		1,
    		2,
    		3,
    		4,
    		5,
    		6,
    		7,
    		8,
    		9,
    		10,
    		11,
    		12,
    		13,
    		14,
    		15,
    		16,
    	];
    	$create = true;
    	$read = true;
    	$update = true;
    	$delete = true;
    	foreach ($modulos as $modulo) {
    		foreach ($roles as $rol) {
    			switch ($rol) {
    				case 1: 
    					DB::table('modulos_has_roles')->insert([
							'modulo_id' => $modulo,
							'rol_id' => $rol,
							'create' => $create,
							'read' => $read,
							'update' => $update,
							'delete' => $delete,
						]);
    					break;
    				case 2: 
    					if ($modulo == 13) {
			    			DB::table('modulos_has_roles')->insert([
			    				'modulo_id' => $modulo,
			    				'rol_id' => $rol,
			    				'create' => $create,
			    				'read' => $read,
			    				'update' => $update,
			    				'delete' => $delete,
			    			]);
		    			}
		    			else if ($modulo == 14) {
			    			DB::table('modulos_has_roles')->insert([
			    				'modulo_id' => $modulo,
			    				'rol_id' => $rol,
			    				'read' => $read,
			    				'update' => $update,
			    			]);
		    			}
		    			else {
		    				DB::table('modulos_has_roles')->insert([
			    				'modulo_id' => $modulo,
			    				'rol_id' => $rol,
			    			]);
		    			}
    					break;
    				case 3: 
    					if ($modulo == 13) {
			    			DB::table('modulos_has_roles')->insert([
			    				'modulo_id' => $modulo,
			    				'rol_id' => $rol,
			    				'read' => $read,
			    				'update' => $update,
			    			]);
		    			}
		    			else if ($modulo == 14) {
			    			DB::table('modulos_has_roles')->insert([
			    				'modulo_id' => $modulo,
			    				'rol_id' => $rol,
			    				'read' => $read,
			    				'update' => $update,
			    			]);
		    			}
		    			else {
		    				DB::table('modulos_has_roles')->insert([
			    				'modulo_id' => $modulo,
			    				'rol_id' => $rol,
			    			]);
		    			}
    					break;
    			}
    		}
    	}
    }
}
