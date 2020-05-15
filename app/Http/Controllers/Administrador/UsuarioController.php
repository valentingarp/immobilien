<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use Auth;

class UsuarioController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    public function index(Request $request){
    	$nombres = $request->get('search');

    	$user = DB::table('users as u')
    	->join('tipousuario as tu','tu.nid_tipousuario','=','u.nid_tipousuario')
    	->select('u.*','tu.nid_tipousuario','tu.cusuario')
    	->where(function ($q) use ($nombres){
                $q->where('u.name', 'LIKE', "%".$nombres."%")
                ->orwhere('u.email','LIKE','%'.$nombres.'%');//modficado for HJMCODE
        })
    	//->where('tu.nid_tipopersona','=',1)//solo administrativos
    	->orderBY('u.id')
    	->paginate(15);//dd($user);
    	$tipouser = DB::table('tipousuario')->get();
    	$first = $user->firstItem();
    	return view('administrador.usuario.index',['nombres'=>$nombres,'user'=>$user,'tipouser'=>$tipouser,'first'=>$first]);
    }
    public function store(Request $request){
    	
    	if (isset($_POST['btnupdate'])) {
    		request()->validate([        
        		'usuario' => 'unique:users,email,'.$_POST['iduser'],
    		]);
    		$upda = User::findOrFail($_POST['iduser']);
    		$upda->nid_tipousuario = $_POST['tipouser'];
    		//$upda->name = $_POST['nombres'];
    		$upda->email = $request->usuario;
    		$upda->update();
    		$info = 1;
    	}

    	if (isset($_POST['btnupdateclave']) and !empty($_POST['clave'])) {
    		$upda = User::findOrFail($_POST['iduser']);
    		$upda->password = Hash::make($_POST['clave']);
    		$upda->update();
    		$info = 2;
    	}

    	if (isset($_POST['disabled'])) {
    		$upda = User::findOrFail($_POST['iduser']);
    		$upda->nestado = 0;
    		$upda->update();
    		$info = 3;
    	}
    	if (isset($_POST['enabled'])) {
    		$upda = User::findOrFail($_POST['iduser']);
    		$upda->nestado = 1;
    		$upda->update();
    		$info = 4;
    	}
    	
    	return $this->index($request)->with(compact('info'));
    }
}
