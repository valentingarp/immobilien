<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Administrador\ProcesoFase;

class ProcesoFaseController extends Controller
{
   public function __construct(){
   	$this->middleware('auth');
   }

   public function index(){
   	$proceso = DB::table('proceso as p')
    ->where('p.nestado','=',1)
    ->orderBy('p.cproceso')
    ->get();
    $profase = DB::table('procesofase as pf')
    ->join('proceso as p','p.nid_proceso','=','pf.nid_proceso')
    ->join('fase as f','f.nid_fase','=','pf.nid_fase')
    ->select('f.nid_fase','f.cfase','p.nid_proceso','p.cproceso','pf.nid_procesofase')
    ->where('pf.nestado','=',1)
    ->orderBy('pf.nid_procesofase')
    ->get();
    $fase = DB::table('fase as f')
    ->where('f.nestado','=',1)
    ->orderBy('f.cfase')
    ->get();
   	return view('administrador.procesofase.index',['proceso'=>$proceso,'profase'=>$profase,'fase'=>$fase]);
   }

   public function store(){
	   	if (isset($_POST['addprocfase'])) {
	   		$profa = new ProcesoFase;
	   		$profa->nid_proceso = $_POST['nid_proceso'];
	   		$profa->nid_fase = $_POST['nid_fase'];
	   		$profa->nestado = 1;
	   		$profa->save();

	   		$info = 1;
	   	}
	   	if (isset($_POST['updateprocfase'])) {
	   		$upda = ProcesoFase::findOrfail($_POST['nid_procesofase']);
	   		$upda->nid_fase = $_POST['nid_fase'];
	   		$upda->update();

	   		$info = 2;
	   	}	   	
    	return $this->index()->with(compact('info'));
   }
   	public function destroy($nid_procesofase){
   		$upda = ProcesoFase::findOrfail($nid_procesofase);
	   	$upda->nestado = 0;
	   	$upda->update();

	   	$info = 3;	   	
    	return $this->index()->with(compact('info'));
   	}
}
