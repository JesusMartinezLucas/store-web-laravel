@extends('layouts.app')

@section('search')
    <x-search :route="$searchRoute" :search="$search" />
@endsection

@section('content')
<div class="flex flex-col justify-center">
    @if (isset($category))
        <div class="flex flex-wrap items-baseline bg-white rounded-lg pt-6 pl-6">
            <p>
                Productos de la categoría <span class="lowercase font-bold mr-4"> {{ $category->name }} </span>
            </p>
            <a href="{{ route('products.index') }}" class="text-blue-500 text-sm"> Ver de todas </a>
        </div>
    @endif

    <div class="w-full flex flex-wrap justify-center md:justify-between bg-white py-6 px-4 rounded-lg">

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