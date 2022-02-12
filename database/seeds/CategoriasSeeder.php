<?php
use Illuminate\Database\Seeder;
class CategoriasSeeder extends Seeder
{
    public function run()
    {
        $componentes = [
        	(object) [ "componente" => "Ram", "capacidad" => true ],
        	(object) [ "componente" => "Processors", "capacidad" => false ],
        	(object) [ "componente" => "HDD", "capacidad" => true ],
        	(object) [ "componente" => "SDD", "capacidad" => true ],
        	(object) [ "componente" => "Motherboards", "capacidad" => false ],
        	(object) [ "componente" => "Graphic Card", "capacidad" => true ],
        	(object) [ "componente" => "Cases", "capacidad" => false ],
        ];
        $accesorios = [
        	(object) [ "periferico" => "Mice", "capacidad" => false  ],
        	(object) [ "periferico" => "Keyboards", "capacidad" => false  ],
        ];
        $equipos_comp = [
        	(object) [ "equipo" => "Desktops", "capacidad" => false  ],
        	(object) [ "equipo" => "Laptops", "capacidad" => false  ],
        ];
        $equipos_red = [
        	(object) [ "equipo" => "Routers", "capacidad" => false  ],
        	(object) [ "equipo" => "Switches", "capacidad" => false  ],
        ];
        foreach ($componentes as $value) {
        	DB::table('categorias')->insert([
        		'sub_clase_id' => 1,
	            'categoria' => $value->componente,
                'ver_capacidad' => $value->capacidad,
	        ]);
        }
        foreach ($accesorios as $value) {
        	DB::table('categorias')->insert([
        		'sub_clase_id' => 2,
	            'categoria' => $value->periferico,
                'ver_capacidad' => $value->capacidad,
	        ]);
        }
        foreach ($equipos_comp as $value) {
        	DB::table('categorias')->insert([
        		'sub_clase_id' => 3,
	            'categoria' => $value->equipo,
                'ver_capacidad' => $value->capacidad,
	        ]);
        }
        foreach ($equipos_red as $value) {
        	DB::table('categorias')->insert([
        		'sub_clase_id' => 4,
	            'categoria' => $value->equipo,
                'ver_capacidad' => $value->capacidad,
	        ]);
        }
    }
}
