<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //valida que si existe una sesion y si no lo manda al login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        //Helper que ayuda para saber que usuario esta autenticado.
        //dd(auth()->user());
        //Recibe los valores del modelo para pasarlos al dashbord
        return view('dashboard', [
            'user' => $user
        ]);
    }
    public function create()
    {
        return view('posts.create');
    }
}
