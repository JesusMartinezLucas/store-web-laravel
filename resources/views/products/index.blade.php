@extends('layouts.app')

@section('search')
<form action="{{ route('products.search') }}" method="GET" class="mr-2">
    <label for="search" class="sr-only">Buscar</label>
    <input type="text" name="search" id="search" placeholder="Buscar ..."
    class="bg-gray-100 border-2 w-full px-4 py-2 rounded-lg @error('search')
    border-red-500 @enderror" value="{{ old('search', isset($search) ? $search : '') }}">

    @error('search')
        <div class="text-red-500 mt-2 text-sm">
            {{$message}}
        </div>
    @enderror
</form>
@endsection

@section('content')
<div class="flex justify-center">
    <div class="w-full flex flex-wrap justify-center md:justify-between bg-white p-6 rounded-lg">

        @if ($products->count())
            @foreach ($products as $product)
                <x-product :product="$product" /> 
            @endforeach

            {{ $products->links() }}
        @else
            <p>No hay productos</p>
        @endif
        
    </div>

    @auth
    <x-links.create :route="route('products.create')">
        <x-icons.plus />
    </x-links.create>
    @endauth
</div>
@endsection