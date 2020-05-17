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
        ->get();//dd($proser);

    	$estadoproyecto = DB::table('estadoproyecto as ep')
        ->where('ep.nestado','=',1)
        ->get();//dd($proser);
  


    	return view('administrador.proyecto.create',['proser'=>$proser,'estadoproyecto'=>$estadoproyecto]);
    }



    /*----------------GET SERVICIOS PROCESOS AXIOS------------*/
     public function servicio(Request $request){
        $id_proceso =  $request->get('proceso_id');
        $servicio = DB::table('procesoservicio as ps')
        ->join('servicio as s','s.nid_servicio','=','ps.nid_servicio')
        ->join('proceso as p','p.nid_proceso','=','ps.nid_proceso')
        ->where('ps.nestado','=',1)
        ->select('s.cservicio','s.nid_servicio','ps.nid_procesoservicio')
        ->where('ps.nid_proceso','=',$id_proceso)
        ->get();

        return response()->json($servicio);

    }


    public function actividad(Request $request){
        $id_proser =  $request->get('proser_id');

        $actividad = DB::table('servicioactividad as sa')
        ->join('actividad as a','a.nid_actividad','=','sa.nid_actividad')
        ->join('constante as et','et.nvalor','=','sa.ncodetapa')
       // ->select('sa.ncodetapa','a.cactividad')
        ->select(DB::raw("CONCAT(cactividad,' ', et.cdescripcion) as cactividad"),'sa.nid_servicioactividad')
        ->where('sa.nid_procesoservicio','=',$id_proser)
        ->where('sa.nestado','=',1)
         ->where('et.ncodconstante','=',4)//etapas
        ->where('et.nvalor','>',0)
        ->get();//dd($actividad);


        return response()->json($actividad);
    }

    public function store(Request $request){
        //print_r($_POST);exit();
        $pro = new Proyecto();
        $pro->cproyecto = $_POST['cnombre'];
        $pro->nid_cliente = $_POST['nid_persona'];
        $pro->nid_procesoservicio = $_POST['servicio'];
        $pro->nid_servicioactividad = $_POST['actividad'];
        $pro->nid_estadoproyecto = $_POST['estado'];
        $pro->nestado = 1;
        $pro->save();
        return $this->index($request);
    }

    public function buscacliente(Request $request){
        if ($request->get('query')) {

            $query = $request->get('query');
            $data = DB::table('persona as pe')
            ->where(DB::raw("CONCAT(pe.capaterno,' ',pe.camaterno)"), 'LIKE', "%".$query."%")
            ->where('pe.nestado','>=',1)
            ->get();
            
            $output = '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="iddropdownmenu" style="display:block; position:absolute">';
            foreach ($data as $row) {
                $output.='<a class="dropdown-item idlist" href="#" ><span style="display: none;">'.$row->nid_persona.' </span>'.$row->cnombre.' '.$row->capaterno.' '.$row->camaterno.'</a>';
            }
            $output.= '</div>';
            echo $output;
        }
    }
}
