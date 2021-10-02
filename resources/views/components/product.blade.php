<div class="mb-4">
    <a href="{{ route('categories.products', $product->category) }}" class="font-bold">{{ $product->category->name }}</a> <span
    class="text-gray-600 text-sm"> $ {{ $product->price }}</span>

    <p>{{ $product->description }}</p>

    @auth
        <div>
            <form action="{{ route('products.destroy', $product) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">Eliminar</button>
            </form>
        </div>
    @endauth

</div>