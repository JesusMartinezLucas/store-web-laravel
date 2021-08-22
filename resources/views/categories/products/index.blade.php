@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @if ($products->count())
            @foreach ($products as $product)
                <div class="mb-4">
                    <a href="{{ route('categories.products', $product->category) }}" class="font-bold">{{ $product->category->name }}</a> <span
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