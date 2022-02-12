<?php
use Illuminate\Database\Seeder;
class NomenclaturasSeeder extends Seeder
{
    public function run()
    {
        $nomenclatura = [
	        (object) [
	            'descripcion' => 'Megabyte',
	            'abreviatura' => 'Mb'
	        ],
	        (object) [
	            'descripcion' => 'Gigabyte',
	            'abreviatura' => 'GB'
	        ],
	        (object) [
	            'descripcion' => 'Terabyte',
	            'abreviatura' => 'TB'
	        ],
	    ];
	    foreach ($nomenclatura as $key => $value) {
        	DB::table('nomenclaturas')->insert([
	        	'nomenclatura' => $value->descripcion,
                'abreviatura' => $value->abreviatura,
	        ]);
        }
    }
}
