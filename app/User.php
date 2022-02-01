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
        'password', 'remember_token'
    ];
    public $timestamps = false;
    public function rol ()
    {
        return $this->belongsTo('App\Rol', 'rol_id')->first();
    }
    public function genero ()
    {
        return $this->belongsTo('App\Genero', 'genero_id')->first();
    }
    public function estatu ()
    {
        return $this->belongsTo('App\Estatu', 'estatus_id')->first();
    }
}
