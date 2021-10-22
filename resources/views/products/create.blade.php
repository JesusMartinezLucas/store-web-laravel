@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full md:w-5/12 bg-white m-6 p-6 rounded-lg">
        <form action="{{ route('products.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="category" class="sr-only">Categoría</label>
                <select name="category" id="category" 
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('category')
                border-red-500 @enderror">

                    <option value="">Selecciona una categoría</option>
                    @foreach($categories as $category)
                        <option 
                            value="{{ $category->id }}"
                            @if(old('category') == $category->id) selected @endif
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

                @error('category')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="sr-only">Descripción</label>
                <textarea name="description" id="description" rows="2" class="bg-gray-100 block
                border-2 w-full p-4 rounded-lg @error('description') border-red-500 @enderror"
                placeholder="Descripción"></textarea>

                @error('description')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

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

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded
                font-medium w-full">Nuevo Producto</button>
            </div>
        </form>
    </div>
</div>
@endsection