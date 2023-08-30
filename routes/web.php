<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});
//EL NAME NOS AYUDA PARA PONERLO EN LOS HAPPERS PARA LA OPCION {{ route('name') }}
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'index'])->name('logout');

//Recibe los valores del modelo 
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');