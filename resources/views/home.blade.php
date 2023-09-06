@extends('layouts.app')
@section('titulo')
Pagina principal

@endsection
@section('contenido')
<!--Es un forech pero con condicion si existe algo lo imprime  es lo mismo que el de abajo 
    @forelse ($posts as $item)
        <h1>{{$item->titulo}}</h1>
    @empty
        <p>No Hay posts</p>
    @endforelse
-->
    <!--Este es un componente que se le pasa informacion-->
             <x-listar-post :posts="$posts"/>

@endsection