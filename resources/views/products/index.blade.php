@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <form action="{{ 'products' }}" method="post" class="mb-4">
            @csrf

            <div class="mb-4">
                <label for="category" class="sr-only">Categoría</label>
                <input type="number" name="category" id="category" placeholder="Categoría"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('category')
                border-red-500 @enderror" value="{{ old('category') }}">

                @error('category')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
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

            <div class="mb-4">
                <label for="quantity" class="sr-only">Cantidad</label>
                <input type="number" name="quantity" id="quantity" placeholder="Cantidad"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('quantity')
                border-red-500 @enderror" value="{{ old('quantity') }}">

                @error('quantity')
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

        @if ($products->count())
            @foreach ($products as $product)
                <div class="mb-4">
                    <a href="" class="font-bold">{{ $product->category->name }}</a> <span
                    class="text-gray-600 text-sm"> $ {{ $product->price }}</span>

                    <p>{{ $product->description }}</p>

                    <div>
                        <form action="{{ route('products.destroy', $product) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-500">Eliminar</button>
                        </form>
                    </div>

                    <div class="flex items-center">
                        @auth
                            @if ($product->inStock())
                                <form action="{{ route('products.sales', $product) }}" method="post" class="mr-1">
                                    @csrf
                                    <button type="submit" class="text-blue-500">Vender</button>
                                </form>
                            @endif
                        @endauth
                        
                        <span class="mr-1">{{ $product->sales->count() }} {{ Str::plural('vendido', 
                        $product->sales->count()) }}</span>

                        @auth 
                            @can('deleteLastSale', $product)
                                <form action="{{ route('products.sales', $product) }}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-blue-500">Devolver última venta</button>
                                </form>
                            @endcan
                        @endauth
                    </div>

                </div>
            @endforeach

            {{ $products->links() }}
        @else
            <p>No hay productos</p>
        @endif
        
    </div>
</div>
@endsection