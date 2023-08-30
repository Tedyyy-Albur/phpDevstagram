<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
       //Validacion
       $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required', //con el confirmed nos ayuda a que valide con el otro input ya que el name se lo dimos y lo detecta el framwork
    ]);
    if(!auth()->attempt($request->only('email','password'), $request->remember))
    {
        return back()->with('mensaje','Credencial bad');
    }
    
    return redirect()->route('posts.index', auth()->user()->username);

    }
}
