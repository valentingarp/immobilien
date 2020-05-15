<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        if (Auth::user()->nid_tipousuario == 1) {
            //comprobar si contraseña fue actualizada
            $per = DB::table('persona as p')
            ->join('users as u','u.nid_persona','=','p.nid_persona')
            ->where('u.email','=',Auth::user()->email)
            ->where('u.nid_tipousuario','=',1)
            ->get();//dd($per);
            if(Hash::check(Auth::user()->email, Auth::user()->password)){
                return view('administrador/home',['changepass'=>1]);
            }else{
                return view('administrador/home',['changepass'=>0]);
            }    

        }else{
            return view('home');    
        }
        
    }
    public function changepass(){
        $per = DB::table('persona as p')
        ->join('users as u','u.nid_persona','=','p.nid_persona')
        ->where('u.email','=',Auth::user()->email)
        ->get();//dd($per);
        //validar claves
        $email = Auth::user()->email;
        if ($_POST['claveuno'] == $email) {
            $info = 0;
            return $this->index()->with(compact('info'));
        }
        if ($_POST['claveuno'] == $_POST['clavedos']) {
            if (Hash::check($_POST['claveuno'], Auth::user()->password)) {
                $info = 2;
                return $this->index()->with(compact('info'));
            }else{
                //update
                $doc = User::findOrFail($per[0]->id);
                $doc->password = bcrypt($_POST['clavedos']);
                //$doc->resetclave = 1;
                $doc->update();
                Auth::logout();
                return redirect('/');
            }
        }else{
            $info = 1;
            return $this->index()->with(compact('info'));
        }
    }

    /*public function index()
    {
        return view('home');
    }*/
}
