<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersSeeder extends Seeder
{
    public function run()
    {
    	$fecha = new \Datetime('now');
        $users = [
        	(object) [
        		'nombre' => 'admin',
        		'apellido' => 'system',
        		'genero' => 1,
        		'correo' => 'admininventario@gmail.com',
        		'estatus' => 1,
        		'rol' => 1,
        		'username' => 'admin',
        		'password' => Hash::make('admins'),
        		'fecha_registro' => $fecha
        	],
        ];
        foreach ($users as $user) {
        	DB::table('users')->insert([
        		'nombre' => $user->nombre,
        		'apellido' => $user->apellido,
        		'genero_id' => $user->genero,
        		'correo' => $user->correo,
        		'estatus_id' => $user->estatus,
        		'rol_id' => $user->rol,
        		'username' => $user->username,
        		'password' => $user->password,
        		'fecha_registro' => $user->fecha_registro,
        	]);
        }
    }
}
