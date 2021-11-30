<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ModuloByRol extends Model
{
    protected $table = 'modulos_has_roles';
    public $timestamps = false;
}
