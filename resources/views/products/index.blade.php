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
    <a class="fixed right-8 bottom-8 sm:right-16 sm:bottom-16 rounded-full bg-blue-500 p-2" href="{{ route('products.create') }}">
        <svg class="inline text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
    </a>
    @endauth
</div>
@endsection