<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class MarcaByCategoria extends Model
{
    protected $table = 'marcas_has_categorias';
    public $timestamps = false;
    public function marca ()
    {
        return $this->belongsTo('App\Marca', 'marca_id')->first();
    }
    public function categoria ()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id')->first();
    }
}
