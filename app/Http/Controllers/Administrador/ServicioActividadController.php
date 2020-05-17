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
use App\User;
use Auth;
use DB;


class ServicioActividadController extends Controller
{
    public function __construct(){
   	$this->middleware('auth');
   }

    public function index(Request $request){
        $proceso = $request->get('proceso');

        $procesos = DB::table('proceso as p')
        ->where('p.nestado','=',1)
        ->orderBy('p.cproceso')
        ->get();

        $proser = DB::table('procesoservicio as ps')
        ->join('servicio as s','s.nid_servicio','=','ps.nid_servicio')
        ->join('proceso as p','p.nid_proceso','=','ps.nid_proceso')
        ->where('ps.nestado','=',1)
        ->where('p.nid_proceso','=',$proceso)
        ->get();//dd($proser);

        $actividad = DB::table('servicioactividad as sa')
        ->join('procesoservicio as ps','ps.nid_procesoservicio','=','sa.nid_procesoservicio')
        ->join('actividad as a','a.nid_actividad','=','sa.nid_actividad')
        ->where('ps.nid_proceso','=',$proceso)
        ->where('sa.nestado','=',1)
        ->orderBy('sa.ncodetapa','asc')
        ->get();//dd($actividad);


        $etap = DB::table('servicioactividad as sa')
        ->join('procesoservicio as ps','ps.nid_procesoservicio','=','sa.nid_procesoservicio')
        ->select('sa.ncodetapa')
        ->where('ps.nid_proceso','=',$proceso)
        ->where('sa.nestado','=',1)
        ->groupBy('sa.ncodetapa')
        ->orderBy('sa.ncodetapa','asc')
        ->get();//dd($etap);

        $etapas = DB::table('constante')
        ->where('ncodconstante','=',4)//etapas
        ->where('nvalor','>',0)
        ->get();

      return view('administrador.servicioactividad.index',[
        'proser'=>$proser,'actividad'=>$actividad,'procesos'=>$procesos,'proceso'=>$proceso,'etapas'=>$etapas,'etap'=>$etap]);
    }

    public function store(Request $request){    

        //print_r($_POST);exit();
        if (isset($_POST['addactividad'])) {
                        
            $inser = new Actividad;
            $inser->cactividad = trim($_POST['cactividad']);
            $inser->nestado = 1;    
            $inser->save();

            //grabar en servicio actividad
            $proc = new ServicioActividad;
            $proc->nid_procesoservicio = $_POST['nid_procesoservicio'];
            $proc->nid_actividad = $inser->nid_actividad;
            $proc->ncodetapa = $_POST['ncodetapa'];
            $proc->nestado = 1;
            $proc->save();
            
        }
        if (isset($_POST['editactividad'])) {
            //actualizar tabla actividad
            //validar que el nombre nuevo exista en la tabla
            $sql = DB::table('actividad as a')
            ->where('a.cactividad','=',trim($_POST['cactividad']))
            ->where('a.nestado','=',1)
            ->get();
            if (sizeof($sql) == 0) {
                $inser = Actividad::findOrFail($_POST['nid_actividad']);
                $inser->cactividad = trim($_POST['cactividad']);
                $inser->nestado = 1;    
                $inser->update();    
            }else{
                //usa el id del servicio que existe
                $upd = ServicioActividad::findOrFail($_POST['nid_servicioactividad']);
                $upd->nid_activididad = $sql[0]->nid_actividad;
                $upd->update();
            }
            
        }
        if (isset($_POST['delactividad'])) {
            //eliminar en procesosservicio de
            $proc = ServicioActividad::findOrFail($_POST['nid_servicioactividad']);
            $proc->nestado = 0;
            $proc->update();
        }
        $info = 1;
      return $this->index($request)->with(compact('info'));
    }
    public function update($nid_actividad){
       //antes de eliminar primero hay que validar
        $sql = Actividad::findOrFail($nid_actividad);
        $sql->cactividad = trim($_POST['actividad']);
        $sql->update();
       
        return redirect('administrador/servicioactividad?proceso='.$_POST['proceso'].'&info=1');
    }
    public function destroy($nid_servicioactividad){
        //antes de eliminar primero hay que validar
        $sql = ServicioActividad::findOrFail($nid_servicioactividad);
        $sql->nestado = 0;
        $sql->update();
       
        return redirect('administrador/servicioactividad?proceso='.$_POST['proceso'].'&info=1');
    }

}
