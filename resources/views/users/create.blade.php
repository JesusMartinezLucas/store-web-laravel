@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full md:w-4/12 bg-white m-6 p-6 rounded-lg">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="sr-only">Nombre</label>
                <input type="text" name="name" id="name" placeholder="Nombre" required
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name')
                border-red-500 @enderror" value="{{ old('name') }}">

                @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="sr-only">Correo</label>
                <input type="email" name="email" id="email" placeholder="Correo" required
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email')
                border-red-500 @enderror" value="{{ old('email') }}">

                @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="sr-only">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Contraseña" required
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password')
                border-red-500 @enderror" value="">

                @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="sr-only">Confirmación de contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmación de contraseña" required
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password_confirmation')
                border-red-500 @enderror" value="">

                @error('password_confirmation')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="flex items-center">
                    <input type="checkbox" name="is_admin" id="is_admin" class="mr-2">
                    <label for="is_admin">Es administrador</label>
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded
                font-medium w-full">Guardar usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection