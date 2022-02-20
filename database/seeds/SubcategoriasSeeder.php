<?php
use Illuminate\Database\Seeder;
class SubcategoriasSeeder extends Seeder
{
    public function run()
    {
        $ram = [
        	(object) [ "ram" => "DDR3"],
        	(object) [ "ram" => "DDR4"],
        ];
        $cpu = [
        	(object) [ "cpu" => "Core"],
        	(object) [ "cpu" => "Pentium"],
        	(object) [ "cpu" => "ryzen"],
            (object) [ "cpu" => "Athlon"],
        ];
        $hdd = [
        	(object) [ "dd" => "SATA"],
        	(object) [ "dd" => "IDE"],
        ];
        $ssd = [
        	(object) [ "dd" => "SATA"],
        	(object) [ "dd" => "PCIe"],
            (object) [ "dd" => "M.2"],
        	(object) [ "dd" => "IDE"],
        ];
        $tm = [
        	(object) [ "tm" => "ATX"],
        	(object) [ "tm" => "Micro ATX"],
        	(object) [ "tm" => "Mini ITX"],
        ];
        $tv = [
        	(object) [ "tv" => "GDDR5"],
        	(object) [ "tv" => "GDDR6"],
        ];
        $cases = [
        	(object) [ "cases" => "ATX"],
        	(object) [ "cases" => "E-ATX"],
        ];
        $raton = [
        	(object) [ "raton" => "USB"],
        	(object) [ "raton" => "Wireless"],
        ];
        $teclado = [
        	(object) [ "teclado" => "USB"],
        	(object) [ "teclado" => "Wireless"],
        ];
        $pc = [
        	(object) [ "pc" => "Towers"],
        	(object) [ "pc" => "All in Ones"],
        ];
        $laptop = [
        	(object) [ "pc" => "Traditionals"],
        	(object) [ "pc" => "2 in 1s"],
        ];
        $routers = [
        	(object) [ "router" => "Wifi"],
        	(object) [ "router" => "4g"],
        ];
        $switches = [
        	(object) [ "switch" => "Unmanaged"],
        	(object) [ "switch" => "Managed"],
        ];
        foreach ($ram as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 1,
	            'sub_categoria' => $key->ram,
	        ]);
        }
        foreach ($cpu as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 2,
	            'sub_categoria' => $key->cpu,
	        ]);
        }
        foreach ($hdd as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 3,
	            'sub_categoria' => $key->dd,
	        ]);
        }
        foreach ($ssd as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 4,
	            'sub_categoria' => $key->dd,
	        ]);
        }
        foreach ($tm as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 5,
	            'sub_categoria' => $key->tm,
	        ]);
        }
        foreach ($tv as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 6,
	            'sub_categoria' => $key->tv,
	        ]);
        }
        foreach ($cases as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 7,
	            'sub_categoria' => $key->cases,
	        ]);
        }
        foreach ($raton as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 8,
	            'sub_categoria' => $key->raton,
	        ]);
        }
        foreach ($teclado as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 9,
	            'sub_categoria' => $key->teclado,
	        ]);
        }
        foreach ($pc as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 10,
	            'sub_categoria' => $key->pc,
	        ]);
        }
        foreach ($laptop as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 11,
	            'sub_categoria' => $key->pc,
	        ]);
        }
        foreach ($routers as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 12,
	            'sub_categoria' => $key->router,
	        ]);
        }
        foreach ($switches as $key) {
        	DB::table('sub_categorias')->insert([
        		'categoria_id' => 13,
	            'sub_categoria' => $key->switch,
	        ]);
        }
    }
}
