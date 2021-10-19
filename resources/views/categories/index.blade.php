@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        
        <div class="w-full md:w-8/12 bg-white m-6 p-6 rounded-lg">
            Categorías
        </div>

        <!-- TODO hacer un componente o blade template para este botón que se repite en usuarios 
        Si puede recibir el la ruta e ícono como parámetro -->
        <a class="fixed right-8 bottom-8 sm:right-16 sm:bottom-16 rounded-full bg-blue-500 p-2" href="{{ route('users.create') }}">
            <svg class="inline text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </a>

    </div>
@endsection