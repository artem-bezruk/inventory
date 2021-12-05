<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ModuloByRol extends Model
{
    protected $table = 'modulos_has_roles';
    public $timestamps = false;
    public function modulo ()
    {
        return $this->belongsTo('App\Module', 'id');
    }
    public function rol ()
    {
        return $this->belongsTo('App\Rol', 'id');
    }
}
