<?php
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	if (app()->environment() == 'production') {
    		$this->call([
	        	EstatusSeeder::class,
	        	GenerosSeeder::class,
	        	RolesSeeder::class,
	        	ModulosSeeder::class,
	        	ModulosHasRolesSeeder::class,
	        	AccionesSeeder::class,
	        	UsersSeeder::class,
	        ]);
    	}
    	else {
    		$this->call([
	        	EstatusSeeder::class,
	        	GenerosSeeder::class,
	        	RolesSeeder::class,
	        	ModulosSeeder::class,
	        	ModulosHasRolesSeeder::class,
	        	AccionesSeeder::class,
	        	UsersSeeder::class,
	        ]);
    	}
    }
}
