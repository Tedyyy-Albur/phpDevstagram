<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }
    public function destroy(Request $request, Post $post)
    {
        //se hace esto porque lo filtramos primero por el usuario y tenemos que buscar ah que
        //publicacion vamos a quitarle el like junto el usuario loggeado 
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
