<div class="mb-4">
    <span class="font-bold">{{ $product->category->name }}</span> <span
    class="text-gray-600 text-sm"> $ {{ $product->price }}</span>

    <p>{{ $product->description }}</p>

    @if ($product->barcode)
        <p>{{ $product->barcode }}</p>
    @endif

    <img src="/storage/image/{{ !is_null($product->image) ? $product->image : 'noImage.jpeg' }}" alt="" class="w-1/5">

    @auth
        <div>
            <form action="{{ route('products.destroy', $product) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">Eliminar</button>
            </form>
        </div>
    @endauth

</div>