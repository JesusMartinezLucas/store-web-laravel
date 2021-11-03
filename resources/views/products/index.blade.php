@extends('layouts.app')

@section('search')
    <x-search :route="route('products.search')" :search="isset($search) ? $search : ''" />
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