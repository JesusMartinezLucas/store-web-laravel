<div class="w-96 rounded overflow-hidden shadow-lg flex flex-col justify-between mb-6 mx-2">
    <img class="w-full" src="/storage/image/{{ !is_null($product->image) ? $product->image : 'noImage.jpeg' }}" alt="Imagen del producto">
    <div class="p-4">
        <div class="flex flex-wrap justify-start">
            <a 
                @auth
                    href="{{ route('products.edit', $product) }}"
                @endauth
                class="font-bold text-xl mr-4"
            >
                {{ $product->description }}
            </a>
            <p class="font-bold text-xl">${{ $product->price }}</p>
        </div>
        <div>
            <span class="text-gray-700 font-bold text-base">Categoría: </span>
            <a 
                href="{{ route('categories.products.index', $product->category) }}" 
                class="text-gray-700 text-base"
            >
                {{ $product->category->name }} 
            </a>
        </div>
        @if ($product->barcode)
            <div>
                <span class="text-gray-700 font-bold text-base">Código de barras: </span>
                <span class="text-gray-700 text-base">{{ $product->barcode }} </span>
            </div>
        @endif
    </div>
</div>