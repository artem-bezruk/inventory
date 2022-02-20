<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Capacidad extends Model
{
    protected $table = 'capacidades';
    public $timestamps = false;
    public function nomenclatura ()
    {
        return $this->belongsTo('App\Nomenclatura', 'nomenclatura_id')->first();
    }
}
