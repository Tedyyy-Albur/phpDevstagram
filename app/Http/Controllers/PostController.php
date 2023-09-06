<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //valida que si existe una sesion y si no lo manda al login
    public function __construct()
    {
        //El except ayuda a elegir a que metodos si se pueden acceder si el usuario no
        //esta logiado solo para vizualisacion
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {
        //Helper que ayuda para saber que usuario esta autenticado.
        //dd(auth()->user());

        //paginate() sirve para que te genere el paginador de los archivos
        $posts = Post::where('user_id', $user->id)->latest()->paginate(5);
        
        //Recibe los valores del modelo para pasarlos al dashbord
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);
        //insersion de la base de datos
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
        
        /*//Otra forma de guardar los inserst
        $post = new Post();
        $post->$request->titulo;
        $post->$request->descripcion;
        $post->$request->imagen;
        $post->auth()->user()->id;
        $post->save();*/

        //Forma de hacer un registro con los metodos de relacion creadas dentro del modelo
        /*$request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);*/

        return redirect()->route('posts.index', auth()->user()->username);

    }
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
    public function destroy(Post $post)
    {
        //Este es el archivo de polics que ayuda como validaciones que 
        //ofrece laravel para el uso de validaciones 
        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar la imagen de uploads
        $imagen_path = public_path('uploads/'.$post->imagen);
        if(File::exists($imagen_path))
        {
            unlink($imagen_path);
        }
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
