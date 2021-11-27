<?php
namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'nombre', 'apellido', 'cedula',  'genero_id', 'correo', 'estatus_id', 'rol_id', 'username', 'password', 'fecha_registro',
    ];
    protected $hidden = [
        'password'
    ];
    public $timestamps = false;
    public function rol ()
    {
        return $this->belongsTo('App\Rol', 'id');
    }
}
