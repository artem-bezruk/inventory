<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
class Dashboard extends Model
{
	public function usuarios ()
	{
    	$users = DB::table('users as u')
    		->join('estatus as e', 'u.estatus_id', 'e.id')
    		->where('u.eliminado', 0);
    	$total = $users->count();
    	$activos = $users->where('e.estado', 'Active')->count();
    	$inactivos = $users->where('e.estado', 'Inactive')->count();
    	return [
    		"total" => $total,
    		"activos" => $activos,
    		"inactivos" => $inactivos,
    	];
	}
    public function bienes ()
    {
        $bienes = DB::table('bienes as b')
            ->where('eliminado', 0);
        $total = $bienes->count();
        return [
            "total" => $total,
        ];
    }
    public function actividades()
    {
        $result = DB::table('bitacora')
            ->where('user_id', auth()->user()->id)
            ->limit(10)
            ->orderBy('fecha', 'DESC')
            ->orderBy('hora', 'DESC')
            ->get();
        $actividades = [];
        foreach ($result as $value) {
            $fecha = new \DateTime($value->fecha . " ". $value->hora);
            $actividades[] = (object) [
                'descripcion' => $value->descripcion,
                'ip' => $value->ip,
                'fecha' => $fecha->format('d-m-Y H:i:s'),
            ];
        }
        return $actividades;
    }
}
