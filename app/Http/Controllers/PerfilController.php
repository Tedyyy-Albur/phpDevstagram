<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [ //not_in ayuda a que ese nombre no se pueda poner el usuario y 'in' es para forzar a un nombre especifico 
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:60']
        ]);
        if ($request->imagen) {

            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;

        if ($request->imagen != null) {
            $imagen_path = public_path('perfiles/' . $usuario->imagen);
            if (File::exists($imagen_path)) {
                unlink($imagen_path);
            }
            $usuario->imagen = $nombreImagen ?? null;
        }
        

        if ($request->password != null) {

            if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
                return back()->with('mensaje', 'Credencial bad');
            }
            $usuario->password = $request->passwordNew;
        }


        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
