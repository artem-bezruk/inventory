<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class MarcaByCategoria extends Model
{
    protected $table = 'marcas_has_categorias';
    public $timestamps = false;
}
