<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Administrador\Servicio;
use App\Administrador\Proceso;
use App\Administrador\ServicioProceso;
use App\User;
use Auth;
use DB;


class ServicioProcesoController extends Controller
{
      public function __construct(){
    	$this->middleware('auth');
    }

 public function index(Request $request){
    	$search = $request->get('search');

        $servicio = DB::table('servicio as s')
        ->where('cservicio', 'LIKE', "%".$search."%")        
        ->where('s.nestado','=',1)
        ->paginate(15);
        $first = $servicio->firstItem();
    	return view('administrador.servicioproceso.index',['servicio'=>$servicio,'search'=>$search,'first'=>$first]);
    }

    public function store(Request $request){   	

    	$inser = new Servicio;
    	$inser->cservicio = $_POST['cservicio'];  
    	$inser->nestado = 1;   	
    	$inser->save();

    	return $this->index($request);
    }
    public function update($nid_servicio){
    	$servicio = Servicio::findOrFail($nid_servicio);
    	$servicio->cservicio = $_POST['cservicio'];	
    	$servicio->update();
    	return redirect('administrador/servicioproceso');
    }
    public function destroy($nid_servicio){
    	$servicio = Servicio::findOrFail($nid_servicio);
    	$servicio->nestado = 0;
    	$servicio->update();
    	return redirect('administrador/servicioproceso/');
    }
}
