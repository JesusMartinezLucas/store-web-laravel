<div class="max-w-sm rounded overflow-hidden shadow-lg mb-6">
    <img class="w-full" src="/storage/image/{{ !is_null($product->image) ? $product->image : 'noImage.jpeg' }}" alt="Imagen del producto">
    <div class="p-4">
        <div class="flex flex-wrap justify-start">
            <p class="font-bold text-xl mr-4">{{ $product->description }}</p>
            <p class="font-bold text-xl">${{ $product->price }}</p>
        </div>
        <div>
            <span class="text-gray-700 font-bold text-base">Categoría: </span>
            <span class="text-gray-700 text-base">{{ $product->category->name }} </span>
        </div>
        @if ($product->barcode)
            <div>
                <span class="text-gray-700 font-bold text-base">Código de barras: </span>
                <span class="text-gray-700 text-base">{{ $product->barcode }} </span>
            </div>
        @endif
    </div>
</div>