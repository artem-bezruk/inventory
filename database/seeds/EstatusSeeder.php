<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EstatusSeeder extends Seeder
{
    public function run()
    {
        $estatus = [
        	'Active',
        	'Inactive'
        ];
        foreach ($estatus as $value) {
        	DB::table('estatus')->insert([
        		'estado' => $value,
        	]);
        }
    }
}
