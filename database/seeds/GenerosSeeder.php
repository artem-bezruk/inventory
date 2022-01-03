<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GenerosSeeder extends Seeder
{
    public function run()
    {
        $generos = [
        	'Female',
        	'Male'
        ];
        foreach ($generos as $value) {
        	DB::table('generos')->insert([
        		'genero' => $value,
        	]);
        }
    }
}
