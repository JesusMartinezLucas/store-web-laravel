@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        
        <div class="bg-blue-400 m-6 p-6 rounded-lg">
            <div class="bg-green-400 grid total-products-container gap-2">
                <h2 class="bg-white text-center font-semibold">Descripción</h2>
                <h2 class="bg-white text-center font-semibold">Precio</h2>
                <h2 class="bg-white text-center font-semibold">Cant.</h2>
                <h2 class="bg-white text-center font-semibold">Importe</h2>
                <button type="button" class="bg-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                @foreach ($products as $product)
                <p class="bg-white text-center">{{ $product->description }}</p>
                <p class="bg-white text-center">${{ $product->price }}</p>
                <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-10 bg-white text-center">
                <p class="bg-white text-center">${{ $product->price }}</p>
                <button type="button" class="bg-white text-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                @endforeach
                <h2 class="col-span-3 bg-white text-center font-semibold">Total</h2>
                <p class="col-span-2 bg-white text-center font-bold">$400</p>
            </div>

        </div>

    </div>
@endsection