<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
class Bitacora extends Model
{
    protected $table = 'bitacora';
    public $timestamps = false;
    public function user ()
    {
        return $this->belongsTo('App\User', 'user_id')->first();
    }
    public function modulo ()
    {
        return $this->belongsTo('App\Modulo', 'modulo_id')->first();
    }
    public function accion ()
    {
        return $this->belongsTo('App\Accion', 'accion_id')->first();
    }
    public function registro ($modulo, $item, int $accion, string $ip, string $descripcion)
    {
        $fecha = new \Datetime('now');
        DB::table($this->table)->insert([
            'user_id' => auth()->user()->id,
            'modulo_id' => $modulo,
            'item' => $item,
            'accion_id' => $accion,
            'ip' => $ip,
            'descripcion' => $descripcion,
            'fecha' => $fecha->format('Y-m-d'),
            'hora' => $fecha->format('H:i:s'),
        ]);
    }
}
