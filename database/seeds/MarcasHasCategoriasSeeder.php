<?php
use Illuminate\Database\Seeder;
class MarcasHasCategoriasSeeder extends Seeder
{
    public function run()
    {
    	$table = 'marcas_has_categorias';
        $categorias = [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ];
        $marcas = [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ];
        foreach ($categorias as $categoria) {
        	foreach ($marcas as $marca) {
        		if ($categoria == 1 && in_array($marca, [2, 9, 16])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 2 && in_array($marca, [6, 7])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 3 && in_array($marca, [9, 10, 11])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 4 && in_array($marca, [9, 10, 11])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 5 && in_array($marca, [12, 13])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 6 && in_array($marca, [6, 8, 12, 13])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 7 && in_array($marca, [1, 2])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 8 && in_array($marca, [2, 3, 4, 11, 12])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 9 && in_array($marca, [2, 3, 4, 11, 12])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 10 && in_array($marca, [2, 3, 4, 8, 11, 12])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 11 && in_array($marca, [2, 3, 4, 8, 11, 12])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 12 && in_array($marca, [14, 15])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        		if ($categoria == 13 && in_array($marca, [14, 15])) {
        			DB::table($table)->insert([
        				'marca_id' => $marca,
        				'categoria_id' => $categoria,
        			]);
        		}
        	}
        }
    }
}
