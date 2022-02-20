<?php
use Illuminate\Database\Seeder;
class MarcasSeeder extends Seeder
{
    public function run()
    {
        $marcas = [
        	"Doesn't apply",
        	"Corsair",
        	"HP",
        	"Compaq",
        	"Lenovo",
        	"AMD",
        	"Intel",
        	"NVIDIA",
        	"Samsung",
        	"Seagate",
        	"Western Digital",
        	"MSI",
        	"ASUS",
        	"TP-LINK",
        	"D-LINK",
        	"PNY Electronics",
        ];
        foreach ($marcas as $value) {
        	DB::table('marcas')->insert([
                'marca' => $value,
            ]);
        }
    }
}
