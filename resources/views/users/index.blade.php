@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white m-6 p-6 rounded-lg">

            <a class="bg-blue-500 text-white px-4 py-2 rounded font-medium" 
                href="{{ route('users.create') }}" >
                    Nuevo usuario
            </a>
            
        </div>
    </div>
@endsection