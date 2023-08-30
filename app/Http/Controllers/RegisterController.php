<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }
    public function store(Request $request) {
        //Es una forma de debuggear para ver que se manda.
        //####dd($request);
        //Forma de obtener los valores declarados en el formulario
        //###dd($request->get('name'));

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion
        $this->validate($request, [
            'name' => 'required|min:5',
            'username' => ['required', 'unique:users','min:3','max:20'],
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6', //con el confirmed nos ayuda a que valide con el otro input ya que el name se lo dimos y lo detecta el framwork

        ]);
        


        //Esta es un metodo para hacer el registro a la base de datos
        //es equivalente a un insert into...
        User::create([
            'name' => $request->name,
            //lower: lo pasa a minisculas 
            //slug: mantiene en minisculas y sin espacios con "-"
            'username' =>$request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Otra forma de autenticar
        #####auth()->attempt($request->only('email', 'password'));
        
        //Autenticar usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);


        return redirect()->route('posts.index');
        


    }     
}
