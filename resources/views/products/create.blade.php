@extends('layouts.app')

@section('content')

<div class="flex justify-center">
    <div class="w-full bg-white m-6 rounded-lg">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 p-6 pb-0 md:pb-6 md:pr-3">
                    <div class="mb-4">
                        <label for="category" class="sr-only">Categoría</label>
                        <select name="category" id="category" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('category')
                        border-red-500 @enderror">

                            <option value="">Selecciona una categoría</option>
                            @foreach($categories as $category)
                                <option 
                                    value="{{ $category->id }}"
                                    @if(old('category') == $category->id) selected @endif
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

                    <div class="mb-4">
                        <label for="barcode" class="sr-only">Código de barras</label>
                        <input type="text" name="barcode" id="barcode" placeholder="Código de barras"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('barcode')
                        border-red-500 @enderror" value="{{ old('barcode') }}">

                        @error('barcode')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="sr-only">Descripción</label>
                        <textarea name="description" id="description" rows="2" required class="bg-gray-100 block
                        border-2 w-full p-4 rounded-lg @error('description') border-red-500 @enderror"
                        placeholder="Descripción">{{ old('description') }}</textarea>

                        @error('description')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4 md:mb-0">
                        <label for="price" class="sr-only">Precio</label>
                        <input type="number" step="0.01" name="price" id="price" placeholder="Precio" required
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('price')
                        border-red-500 @enderror" value="{{ old('price') }}">

                        @error('price')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col w-full md:w-1/2 p-6 pt-0 md:pt-6 md:pl-3">
                    <div class="mb-4">
                        <label for="image" class="">Imagen del producto:</label>
                        <input type="file" name="image" id="image" capture="user" accept="image/*"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('image')
                        border-red-500 @enderror">

                        @error('image')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="flex flex-1 justify-center items-center">
                        <img src="/storage/image/noImage.jpeg" id="preview" alt="Imagen del producto" class="w-64">
                    </div>
                </div>
            </div>
            <div class="flex justify-center mb-6 mx-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded
                font-medium w-full md:w-1/4">Guardar producto</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('js/image.js') }}"></script>

<script>
    $(document).ready(function () {

        $(document).on('change', '#image', function (e) {
            e.preventDefault();

            const files = $(this).prop('files');
            setImageSrc(files, null, setImagePreview);
        });

        function setImagePreview(src) {
            $('#preview').attr("src", src);
        }

    });
</script>

@endsection