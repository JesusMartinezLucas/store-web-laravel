@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 m-6 bg-white">
        <div class="p-6">
            <h1 class="text-2xl font-medium mb-1">{{ $category->name }}</h1>
            <p>{{ $products->count() }} {{ Str::plural('producto', $products->count()) }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg">
            @if ($products->count())
                @foreach ($products as $product)
                    <x-product :product="$product" /> 
                @endforeach

                {{ $products->links() }}
            @else
                <p>La {{ $category->name }} no tiene productos</p>
            @endif
        </div>
    </div>
</div>
@endsection