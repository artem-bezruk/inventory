<?php
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	$this->call([
        	EstatusSeeder::class,
        	GenerosSeeder::class,
        	RolesSeeder::class,
        	ModulosSeeder::class,
        	ModulosHasRolesSeeder::class,
        	AccionesSeeder::class,
        	ClasesSeeder::class,
        	SubclasesSeeder::class,
        	NomenclaturasSeeder::class,
        	MarcasSeeder::class,
        	CapacidadesSeeder::class,
            CategoriasSeeder::class,
            SubcategoriasSeeder::class,
            MarcasHasCategoriasSeeder::class,
        	UsersSeeder::class,
        ]);
    }
}
