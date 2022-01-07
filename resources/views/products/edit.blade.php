@extends('layouts.app')

@section('content')

<div class="flex justify-center">
    <div class="w-full bg-white m-6 rounded-lg">

        @if (session('status'))
            <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 p-6 pb-0 md:pb-6 md:pr-3">
                    <div class="mb-2">
                        <label for="category">Categoría</label>
                        <select name="category" id="category" 
                        class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('category')
                        border-red-500 @enderror">

                            <option value="">Selecciona una categoría</option>
                            @foreach($categories as $category)
                                <option 
                                    value="{{ $category->id }}"
                                    @if(old('category', $product->category->id ) == $category->id) selected @endif
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="barcode">Código de barras</label>
                        <input type="text" name="barcode" id="barcode"
                        class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('barcode')
                        border-red-500 @enderror" value="{{ old('barcode', $product->barcode) }}">

                        @error('barcode')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" rows="2" required class="bg-gray-100 block
                        border-2 w-full p-2 rounded-lg @error('description') border-red-500 @enderror"
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4 md:mb-0">
                        <label for="price">Precio</label>
                        <input type="number" step="0.01" name="price" id="price" required
                        class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('price')
                        border-red-500 @enderror" value="{{ old('price', $product->price) }}">

                        @error('price')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col w-full md:w-1/2 p-6 pt-0 md:pt-6 md:pl-3">
                    <div class="mb-4">
                        <div class="w-full text-center">
                            <label for="image" class="bg-blue-500 text-white px-4 py-2 rounded @error('image')
                            border-red-500 @enderror">Foto</label>
                        </div>
                        <input type="file" name="image" id="image" capture="user" accept="image/*" class="hidden">

                        @error('image')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="flex flex-1 justify-center items-center">
                        <img 
                            src="/storage/image/{{ !is_null($product->image) ? $product->image : 'noImage.jpeg' }}" 
                            id="preview" alt="Imagen del producto" class="w-64"
                        >
                    </div>
                </div>
            </div>
            <div class="flex justify-center mb-6 mx-6">
                <button id="submitButton" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded
                font-medium w-full md:w-1/4">Actualizar producto</button>
            </div>
        </form>

        <form action="{{ route('products.destroy', $product) }}" method="POST" class="text-left" >
            @csrf
            @method('DELETE')
            <button 
                type="submit"
                class="text-red-400 ml-6 mb-4" 
                onclick="return confirm('¿Estás seguro de eliminar el producto?')"
            >
                Eliminar
            </button>
        </form>
    </div>

    <x-links.create :route="route('products.create')">
        <x-icons.plus />
    </x-links.create>

</div>
@endsection

@section('scripts')

<script src="{{ asset('js/image.js') }}"></script>

<script>
$(document).ready(function () {

    $(document).on('change', '#image', function (e) {
        e.preventDefault();

        const files = $(this).prop('files');
        setImageSrc(files, "{{ $product->image }}", setImagePreview);
    });

    function setImagePreview(src) {
        $('#preview').attr("src", src);

        $('html, body').animate({
            scrollTop: $("#submitButton").offset().top
        }, 2000);
    }

});
</script>

@endsection