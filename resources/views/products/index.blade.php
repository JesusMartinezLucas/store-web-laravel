@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <form action="{{ 'products' }}" method="post">
            @csrf

            <div class="mb-4">
                <label for="price" class="sr-only">Precio</label>
                <input type="number" step="0.01" name="price" id="price" placeholder="Precio"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('price')
                border-red-500 @enderror" value="{{ old('price') }}">

                @error('price')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="sr-only">Descripción</label>
                <textarea name="description" id="description" cols="30" rows="4" class="bg-gray-100
                border-2 w-full p-4 rounded-lg @error('description') border-red-500 @enderror"
                placeholder="Descripción"></textarea>

                @error('description')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded
                font-medium">Nuevo Producto</button>
            </div>

        </form>
    </div>
</div>
@endsection