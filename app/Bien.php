<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Bien extends Model
{
    protected $table = 'bienes';
    public $timestamps = false;
    public function subcategoria ()
    {
        return $this->belongsTo('App\Subcategoria', 'sub_categoria_id')->first();
    }
    public function marca ()
    {
        return $this->belongsTo('App\Marca', 'marca_id')->first();
    }
    public function capacidad ()
    {
        return $this->belongsTo('App\Capacidad', 'capacidad_id')->first();
    }
}
