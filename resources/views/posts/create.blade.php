@push('styles')<!--CON ESTE UNICAMENTE VAMOS A CARGAR LA HOJA DE ESTILOS QUE ESTE EN NUESTRA PANTALLA-->
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />    
@endpush

@extends('layouts.app')
@section('titulo')
    Crea una nueva Publicación
@endsection

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">

        <form id="dropzones" action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data"
        class="dropzone border-dashed border-2 w-full h-96 rounded flex
        flex-col justify-center items-center">

        @csrf
        </form>

    </div>
    <div class="md:w-1/2 px-10 bg-white rounded-lg shadow-xl mt-10">

        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf <!--Genera el token de autenticacion para la seguridad del laravelr-->
            <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase
                text-gray-500 font-bold">Titulo</label>
                <input
                id="titulo"
                name="titulo" 
                type="text"
                placeholder="Titulo de la publicación"
                class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                value="{{ old('name') }}">
                <!--Validacion de formularios.-->
            @error('titulo')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
            {{$message}}    
            </p>
            @enderror
            </div> 

            <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase
                text-gray-500 font-bold">Descripción</label>
                <textarea
                id="descripcion"
                name="descripcion" 
                type="text-area"
                placeholder="Descripción de la publicación"
                class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror"
               > {{ old('descripcion') }}</textarea>
                <!--Validacion de formularios.-->
            @error('descripcion')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
            {{$message}}    
            </p>
            @enderror
            </div> 


            <input type="submit"
            value="Publicar"
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
            uppercase font-bold w-full p-3 text-white rounded-lg">
        
        </form>

    </div>
</div>
    
@endsection