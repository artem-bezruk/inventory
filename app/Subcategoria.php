<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Subcategoria extends Model
{
    protected $table = 'sub_categorias';
    public $timestamps = false;
    public function categoria ()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id')->first();
    }
}
