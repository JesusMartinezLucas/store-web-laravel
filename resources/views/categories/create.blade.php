@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full md:w-4/12 bg-white m-6 p-6 rounded-lg">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="sr-only">Nombre</label>
                <input type="text" name="name" id="name" placeholder="Nombre" required
                class="bg-gray-100 border-2 border-gray-400 w-full p-4 rounded-lg @error('name')
                border-red-500 @enderror" value="{{ old('name') }}">

                @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded
                font-medium w-full">Guardar categoría</button>
            </div>
        </form>
    </div>
</div>
@endsection