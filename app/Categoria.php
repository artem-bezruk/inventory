<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Categoria extends Model
{
    protected $table = 'categorias';
    public $timestamps = false;
    public function subclase ()
    {
        return $this->belongsTo('App\Subclase', 'sub_clase_id')->first();
    }
}
