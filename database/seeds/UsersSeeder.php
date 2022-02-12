<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersSeeder extends Seeder
{
    public function run()
    {
    	$fecha = new \Datetime('now');
        $users = [];
        if (app()->environment('production')) {
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
        }
        else {
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
                (object) [
                    'nombre' => 'attendant',
                    'apellido' => 'system',
                    'genero' => 1,
                    'correo' => 'atteninventario@gmail.com',
                    'estatus' => 1,
                    'rol' => 2,
                    'username' => 'atten',
                    'password' => Hash::make('attens'),
                    'fecha_registro' => $fecha
                ],
                (object) [
                    'nombre' => 'operator',
                    'apellido' => 'system',
                    'genero' => 1,
                    'correo' => 'operatorinventario@gmail.com',
                    'estatus' => 1,
                    'rol' => 3,
                    'username' => 'operator',
                    'password' => Hash::make('operators'),
                    'fecha_registro' => $fecha
                ],
                (object) [
                    'nombre' => 'lisa',
                    'apellido' => 'simpson',
                    'genero' => 1,
                    'correo' => 'lsimpson@gmail.com',
                    'estatus' => 1,
                    'rol' => 1,
                    'username' => 'lsimpson',
                    'password' => Hash::make('pandas'),
                    'fecha_registro' => $fecha
                ],
            ];
        }
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
