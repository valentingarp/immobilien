<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Administrador\ServicioActividad;
use App\Administrador\Proceso;
use App\Administrador\ProcesoServicio;
use App\Administrador\Servicio;
use App\Administrador\Actividad;
use App\Administrador\Proyecto;
use App\Administrador\PermisoProyecto;
use App\Administrador\EstadoProyecto;
use App\User;
use Auth;
use DB;

class ProyectoController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
    	$search = $request->get('search');


        $proyecto = DB::table('proyecto as p')
        ->join('procesoservicio as ps','ps.nid_procesoservicio','=','p.nid_procesoservicio')
        ->join('servicioactividad as sa','sa.nid_servicioactividad','=','p.nid_servicioactividad')
        ->join('persona as pe','pe.nid_persona','=','p.nid_cliente')
        ->where('cproyecto', 'LIKE', "%".$search."%")        
        ->where('p.nestado','=',1)
        ->paginate(20);


        $first = $proyecto->firstItem();


      	

    	return view('administrador.proyecto.index',['proyecto'=>$proyecto,
    		'search'=>$search,'first'=>$first]);

    }

        public function create(){
    	

    	$proser = DB::table('procesoservicio as ps')
        ->join('servicio as s','s.nid_servicio','=','ps.nid_servicio')
        ->join('proceso as p','p.nid_proceso','=','ps.nid_proceso')
        ->where('ps.nestado','=',1)
        //->where('p.nid_proceso','=',$proceso)
        ->get();//dd($proser);


       /*$actividad = DB::table('servicioactividad as sa')
        ->join('procesoservicio as ps','ps.nid_procesoservicio','=','sa.nid_procesoservicio')
        ->join('actividad as a','a.nid_actividad','=','sa.nid_actividad')
        ->where('ps.nid_proceso','=',$proceso)
        ->where('sa.nestado','=',1)
        ->orderBy('sa.ncodetapa','asc')
        ->get();//dd($actividad);*/


    	return view('administrador.proyecto.create',['proser'=>$proser]);
    }


}
