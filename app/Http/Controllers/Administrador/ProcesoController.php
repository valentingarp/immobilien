<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Administrador\Proceso;
use App\Administrador\ProcesoServicio;
use App\Administrador\Servicio;
use App\User;
use Auth;
use DB;

class ProcesoController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
    	$search = $request->get('search');

        $proceso = DB::table('proceso as p')
        ->where('cproceso', 'LIKE', "%".$search."%")        
        ->where('p.nestado','=',1)
        ->paginate(20);
        $first = $proceso->firstItem();

        $proser = DB::table('procesoservicio as ps')
        ->join('servicio as s','s.nid_servicio','=','ps.nid_servicio')
        ->join('proceso as p','p.nid_proceso','=','ps.nid_proceso')
        ->where('ps.nestado','=',1)
        ->get();
    	return view('administrador.proceso.index',['proceso'=>$proceso,'search'=>$search,'first'=>$first,'proser'=>$proser]);
    }

    public function store(Request $request){   	

        if (isset($_POST['addproceso'])) {
        	$inser = new Proceso;
        	$inser->cproceso = trim($_POST['cproceso']);  
        	$inser->nestado = 1;   	
        	$inser->save();
        }

        if (isset($_POST['addservicio'])) {
            //grabar tabla servicio antes validar si existe
            $sql = DB::table('servicio as s')
            ->where('s.cservicio','=',trim($_POST['cservicio']))
            ->where('s.nestado','=',1)
            ->get();

            if (sizeof($sql) == 0) {//servicio nuevo
                $inser = new Servicio;
                $inser->cservicio = trim($_POST['cservicio']);
                $inser->nestado = 1;    
                $inser->save();
                //grabar en procesos servicio
                $proc = new ProcesoServicio;
                $proc->nid_proceso = $_POST['nid_proceso'];
                $proc->nid_servicio = $inser->nid_servicio;
                $proc->nestado = 1;
                $proc->save();
            }else{//servicio ya existe por tanto usa el mismo id
                $proc = new ProcesoServicio;
                $proc->nid_proceso = $_POST['nid_proceso'];
                $proc->nid_servicio = $sql[0]->nid_servicio;
                $proc->nestado = 1;
                $proc->save();
            }
            

            
        }
        if (isset($_POST['editservicio'])) {
            //actualizar tabla servicio
            //validar que el nombre nuevo exista en la tabla
            $sql = DB::table('servicio as s')
            ->where('s.cservicio','=',trim($_POST['cservicio']))
            ->where('s.nestado','=',1)
            ->get();
            if (sizeof($sql) == 0) {
                $inser = Servicio::findOrFail($_POST['nid_servicio']);
                $inser->cservicio = trim($_POST['cservicio']);
                $inser->nestado = 1;    
                $inser->update();    
            }else{
                //usa el id del servicio que existe
                $upd = ProcesoServicio::findOrFail($_POST['nid_procesoservicio']);
                $upd->nid_servicio = $sql[0]->nid_servicio;
                $upd->update();
            }
            
        }
        if (isset($_POST['delservicio'])) {
            //eliminar en procesosservicio de
            $proc = ProcesoServicio::findOrFail($_POST['nid_procesoservicio']);
            $proc->nestado = 0;
            $proc->update();
        }
        $info = 1;
    	return $this->index($request)->with(compact('info'));
    }
    public function update($nid_proceso){
    	$proceso = Proceso::findOrFail($nid_proceso);
    	$proceso->cproceso = trim($_POST['cproceso']);
    	$proceso->update();
    	return redirect('administrador/procesoservicio/?info=1');
    }
    public function destroy($nid_proceso){
        //antes de eliminar primero hay que validar
        $sql = DB::table('procesoservicio as ps')
        ->where('ps.nid_proceso','=',$nid_proceso)
        ->where('ps.nestado','=',1)
        ->get();
        if (sizeof($sql) > 0) { return 'Imposible eliminar, este proceso tiene servicios configurado, elimine primero sus servicios';}
    	$proceso = Proceso::findOrFail($nid_proceso);
    	$proceso->nestado = 0;
    	$proceso->update();
    	return redirect('administrador/procesoservicio/?info=1');
    }
}
