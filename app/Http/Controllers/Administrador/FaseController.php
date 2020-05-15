<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Administrador\Fase;
use App\User;
use Auth;
use DB;

class FaseController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
    	$search = $request->get('search');

        $fase = DB::table('fase as f')
        ->where('cfase', 'LIKE', "%".$search."%")        
        ->where('f.nestado','=',1)
        ->paginate(15);
        $first = $fase->firstItem();
    	return view('administrador.fase.index',['fase'=>$fase,'search'=>$search,'first'=>$first]);
    }

    public function store(Request $request){   	

    	$inser = new Fase;
    	$inser->cfase = $_POST['cfase'];  
    	$inser->nestado = 1;   	
    	$inser->save();

    	return $this->index($request);
    }
    public function update($nid_fase){
    	$fase = Fase::findOrFail($nid_fase);
    	$fase->cfase = $_POST['cfase'];	
    	$fase->update();
    	return redirect('administrador/fase');
    }
    public function destroy($nid_fase){
        //validar si esta fase no esta en proceso-fase 
        $procfase = DB::table('procesofase')
        ->where('nid_fase','=',$nid_fase)
        ->where('nestado','=',1)
        ->get();
        if (sizeof($procfase) > 0) {return 'Esta fase existe en Proceso Fase. No se puede eliminar';}
        
    	$fase = Fase::findOrFail($nid_fase);
    	$fase->nestado = 0;
    	$fase->update();
    	return redirect('administrador/fase/');
    }
}
