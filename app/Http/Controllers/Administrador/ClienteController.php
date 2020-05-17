<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Administrador\Persona;
use App\Administrador\DocumentoPersona;
use App\Administrador\Personageoubicacion;
use Auth;
use DB;

class ClienteController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    public function index(Request $request){
    	$search = $request->get('search');

        $persona = DB::table('persona as p')
        //->join('users as u','u.nid_persona','=','p.nid_persona')
        ->join('tipopersona as tp','tp.nid_tipopersona','=','p.nid_tipopersona')
        ->join('documentopersona as dp','dp.nid_persona','=','p.nid_persona')
        ->where(DB::raw("CONCAT(p.capaterno,' ',p.camaterno,' ',p.cnombre)"), 'LIKE', "%".$search."%")
        ->where('p.nestado','=',1)
        ->where('p.nid_tipopersona','=',2)
        //->whereNotIn('u.nid_tipousuario', [5, 6])
        ->paginate(15);
        $first = $persona->firstItem();
    	return view('administrador.cliente.index',['cliente'=>$persona,'search'=>$search,'first'=>$first]);
    }
    public function create(){
    	$sex = DB::table('constante as c')
        ->where('c.ncodconstante','=',3)
        ->where('c.nvalor','>',0)
        ->get();

    	$doc = DB::table('constante as c')
        ->where('c.ncodconstante','=',0)
        ->where('c.nvalor','>',0)
        ->get();

        $personeria = DB::table('constante as c')
        ->where('c.ncodconstante','=',1)
        ->where('c.nvalor','>',0)
        ->get();
        $regiones = DB::table('regions as r')
        ->select('r.cnombre as nomregion','r.cubigeo_regions')
        ->orderBy('r.cnombre','asc')->get();
    	return view('administrador.cliente.create',['sex'=>$sex,'doc'=>$doc,'personeria'=>$personeria,'regiones'=>$regiones]);
    }
    public function store(Request $request){
    	$nombres = $_POST['cnombre'];
    	if ($_POST['personeria'] == 2) {$nombres = $_POST['razonsocial'];}
    	
    	$per = new Persona;
    	$per->nid_tipopersona = $_POST['tipopersona'];
    	$per->cnombre = $nombres;
    	$per->capaterno = $_POST['cpaterno'];
    	$per->camaterno = $_POST['cmaterno'];
    	$per->dfnacimiento = $_POST['dfnacimento'];
    	$per->npersoneria = $_POST['personeria'];
    	$per->ccorreo = $_POST['ccorreo'];
    	$per->cdomicilio = $_POST['cdomicilio'];
    	$per->ctelefono = $_POST['ctelefono'];
    	$per->nsexo = $_POST['sexo'];
    	$per->cciudad = $_POST['ciudad'];
    	$per->ccelular = $_POST['ccelular'];
    	$per->nestado = 1;
    	$per->save();

    	$docuper = new DocumentoPersona;
    	$docuper->nid_persona = $per->nid_persona;
    	$docuper->ntipodoc = $_POST['tipodocumento'];
    	$docuper->cdocnro = $_POST['numero_de_documento'];
    	$docuper->save();

    	$pergeo = new Personageoubicacion;
    	$pergeo->nid_persona = $per->nid_persona;
    	$pergeo->cubigeo_regions = $_POST['region_domicilio'];
    	$pergeo->cubigeo_provinces = $_POST['provincia_domicilio'];
    	$pergeo->cubigeo_districts = $_POST['distrito_domicilio'];
    	$pergeo->nestado = 1;
    	$pergeo->save();

        $info = 1;
    	return $this->index($request)->with(compact('info'));
    }
    public function edit($id_persona){
    	$persona = DB::table('persona as p')
    	->join('tipopersona as tp','tp.nid_tipopersona','=','p.nid_tipopersona')
    	->join('personageoubicacion as pg','pg.nid_persona','=','p.nid_persona')
    	->join('regions as r','r.cubigeo_regions','=','pg.cubigeo_regions')
    	->join('provinces as pr','pr.cubigeo_provinces','=','pg.cubigeo_provinces')
    	->join('districts as di','di.cubigeo_districts','=','pg.cubigeo_districts')
    	->join('documentopersona as dp','dp.nid_persona','=','p.nid_persona')
    	->join('constante as co','co.nvalor','=','dp.ntipodoc')
    	->join('constante as cop','cop.nvalor','=','p.npersoneria')
    	->join('constante as cos','cos.nvalor','=','p.nsexo')
    	->select('p.*','r.cnombre as region','pr.cnombre as provincia','di.cnombre as distrito','tp.cpersona as tipopersona','co.cdescripcion as tipodoc','cop.cdescripcion as personeria','cos.cdescripcion as sexo','cop.nvalor as tipopersoneria','dp.cdocnro','tp.nid_tipopersona','co.nvalor as idtipodoc','r.cubigeo_regions','pr.cubigeo_provinces','di.cubigeo_districts','cos.nvalor as idsexo','p.nid_persona','dp.nid_docpersona','p.npersoneria')
    	->where('co.ncodconstante','=',0)//tipodocumento
    	->where('cop.ncodconstante','=',1)//personeria
    	->where('cos.ncodconstante','=',3)//sexo
    	->where('p.nid_persona','=',$id_persona)
    	->where('p.nestado','=',1)
    	->get();//dd($persona);

    	$sex = DB::table('constante as c')
        ->where('c.ncodconstante','=',3)
        ->where('c.nvalor','>',0)
        ->get();
        $tipopersona = DB::table('tipopersona')
    	->get();
    	$doc = DB::table('constante as c')
        ->where('c.ncodconstante','=',0)
        ->where('c.nvalor','>',0)
        ->get();
        $regiones = DB::table('regions as r')
        ->select('r.cnombre as nomregion','r.cubigeo_regions')
        ->orderBy('r.cnombre','asc')->get();
       
    	return view('administrador.cliente.edit',['persona'=>$persona,'sex'=>$sex,'doc'=>$doc,'tipopersona'=>$tipopersona,'regiones'=>$regiones]);
    }
    public function update($id_persona,Request $request){
    	
    	if ($_POST['personeria'] == 1) {
    		$paterno = $_POST['cpaterno'];
    		$materno = $_POST['cmaterno'];
    	}else{
    		$paterno = '';
    		$materno = '';
    	}

    	$per = Persona::findOrFail($id_persona);
    	$per->nid_tipopersona = $_POST['tipopersona'];
    	$per->cnombre = $_POST['cnombre'];
    	$per->capaterno = $paterno;
    	$per->camaterno = $materno;
    	$per->dfnacimiento = $_POST['dfnacimento'];
    	$per->npersoneria = $_POST['personeria'];
    	$per->ccorreo = $_POST['ccorreo'];
    	$per->cdomicilio = $_POST['cdomicilio'];
    	$per->ctelefono = $_POST['ctelefono'];
    	$per->nsexo = $_POST['sexo'];
    	$per->cciudad = $_POST['ciudad'];
    	$per->ccelular = $_POST['ccelular'];
    	$per->nestado = 1;
    	$per->update();


    	$docuper = DocumentoPersona::findOrFail($_POST['nid_docpersona']);
    	$docuper->ntipodoc = $_POST['tipodocumento'];
    	$docuper->cdocnro = $_POST['numero_de_documento'];
    	$docuper->update();

    	$pergeo = Personageoubicacion::findOrFail($id_persona);
    	$pergeo->cubigeo_regions = $_POST['region_domicilio'];
    	$pergeo->cubigeo_provinces = $_POST['provincia_domicilio'];
    	$pergeo->cubigeo_districts = $_POST['distrito_domicilio'];
    	$pergeo->nestado = 1;
    	$pergeo->update();

    	//print_r($_POST);exit(); 
    	$info = 2;
    	return $this->index($request)->with(compact('info'));
    }
    public function show($id_persona){
    	$persona = DB::table('persona as p')
    	->join('tipopersona as tp','tp.nid_tipopersona','=','p.nid_tipopersona')
    	->join('personageoubicacion as pg','pg.nid_persona','=','p.nid_persona')
    	->join('regions as r','r.cubigeo_regions','=','pg.cubigeo_regions')
    	->join('provinces as pr','pr.cubigeo_provinces','=','pg.cubigeo_provinces')
    	->join('districts as di','di.cubigeo_districts','=','pg.cubigeo_districts')
    	->join('documentopersona as dp','dp.nid_persona','=','p.nid_persona')
    	->join('constante as co','co.nvalor','=','dp.ntipodoc')
    	->join('constante as cop','cop.nvalor','=','p.npersoneria')
    	->join('constante as cos','cos.nvalor','=','p.nsexo')
    	->select('p.*','r.cnombre as region','pr.cnombre as provincia','di.cnombre as distrito','tp.cpersona as tipopersona','co.cdescripcion as tipodoc','cop.cdescripcion as personeria','cos.cdescripcion as sexo','cop.nvalor as tipopersoneria','dp.cdocnro','tp.nid_tipopersona','co.nvalor as idtipodoc','r.cubigeo_regions','pr.cubigeo_provinces','di.cubigeo_districts','cos.nvalor as idsexo','p.nid_persona','dp.nid_docpersona','p.npersoneria')
    	->where('co.ncodconstante','=',0)//tipodocumento
    	->where('cop.ncodconstante','=',1)//personeria
    	->where('cos.ncodconstante','=',3)//sexo
    	->where('p.nid_persona','=',$id_persona)
    	->where('p.nestado','=',1)
    	->get();//dd($persona);

    	$sex = DB::table('constante as c')
        ->where('c.ncodconstante','=',3)
        ->where('c.nvalor','>',0)
        ->get();
        $tipopersona = DB::table('tipopersona')
    	->get();
    	$doc = DB::table('constante as c')
        ->where('c.ncodconstante','=',0)
        ->where('c.nvalor','>',0)
        ->get();
        $regiones = DB::table('regions as r')
        ->select('r.cnombre as nomregion','r.cubigeo_regions')
        ->orderBy('r.cnombre','asc')->get();
 
    	return view('administrador.cliente.show',['persona'=>$persona,'sex'=>$sex,'doc'=>$doc,'tipopersona'=>$tipopersona,'regiones'=>$regiones]);
    }
    public function destroy($id_persona,Request $request){
    	$del = Persona::findOrFail($id_persona);
        $del->nestado = 0;
        $del->update();

        $info=3;
        return $this->index($request)->with(compact('info'));
    }
}
