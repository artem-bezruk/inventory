<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Subclase extends Model
{
    protected $table = 'sub_clases';
    public $timestamps = false;
    public function clase ()
    {
        return $this->belongsTo('App\Clase', 'clase_id')->first();
    }
}
