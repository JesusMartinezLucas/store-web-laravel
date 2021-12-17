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
                    <div class="mb-4">
                        <label for="category" class="sr-only">Categoría</label>
                        <select name="category" id="category" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('category')
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

                    <div class="mb-4">
                        <label for="barcode" class="sr-only">Código de barras</label>
                        <input type="text" name="barcode" id="barcode" placeholder="Código de barras"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('barcode')
                        border-red-500 @enderror" value="{{ old('barcode', $product->barcode) }}">

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
                        placeholder="Descripción">{{ old('description', $product->description) }}</textarea>

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
                        <label for="image">Imagen del producto:</label>
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
                        <img 
                            src="/storage/image/{{ !is_null($product->image) ? $product->image : 'noImage.jpeg' }}" 
                            id="preview" alt="Imagen del producto" class="w-64"
                        >
                    </div>
                </div>
            </div>
            <div class="flex justify-center mb-6 mx-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded
                font-medium w-full md:w-1/4">Actualizar producto</button>
            </div>
        </form>

        <form action="{{ route('products.destroy', $product) }}" method="POST" class="text-right" >
            @csrf
            @method('DELETE')
            <button 
                type="submit"
                class="text-red-400 mr-6 mb-4" 
                onclick="return confirm('¿Estás seguro de eliminar el producto?')"
            >
                Eliminar
            </button>
        </form>

        <h2 class="text-center">Actualizar imagen</h2>

        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 p-6 pb-0 md:pb-6 md:pr-3 mb-4 md:mb-0">
                <video id="player" controls autoplay class="mb-4"></video>
                <div id="playerErrors" class="text-red-500 mt-2 text-sm">  </div>
                <button id="captureButton" class="hidden bg-blue-500 text-white px-4 py-2 rounded
                    font-medium w-full">Capturar</button>
            </div>
            <div class="flex flex-col w-full md:w-1/2 p-6 pt-0 md:pt-6 md:pl-3">
                <div class="flex flex-1 justify-center items-center mb-4">
                    <canvas id="canvas" width=320 height=240></canvas>
                    <div id="updateImageErrors" class="text-red-500 mt-2 text-sm">  </div>
                </div>
                <button type="button" id="updateImageButton" class="hidden bg-blue-500 text-white px-4 py-2 rounded
                    font-medium w-full">Actualizar imagen</button>
            </div>
        </div>
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
    }

});
</script>

<script>
$(document).ready(function () {

    $(window).scrollTop(0);

    const player = $('#player').get(0);
    const canvas = $('#canvas').get(0);
    const context = canvas.getContext('2d');

    const constraints = {
        video: true,
    };

    navigator.mediaDevices.getUserMedia(constraints)
        .then((stream) => {
            player.srcObject = stream;
            $('#captureButton').removeClass("hidden");
        }).catch(function() {
            $('#playerErrors').html("Sin camara o sin permisos para usar la cámara");
        });

    $(document).on('click', '#captureButton', function (e) {
        e.preventDefault();
        
        context.drawImage(player, 0, 0, canvas.width, canvas.height);
        $('#updateImageButton').removeClass("hidden");
    });

    $(document).on('click', '#updateImageButton', function (e) {
        e.preventDefault();
        $('#updateImageErrors').html("");

        canvas.toBlob(function(blob) {
            const formData = new FormData();
            const image = new File([blob], "image.jpeg", { type: "image/jpeg", });
            formData.append('image', image);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('products.image.update', $product) }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status === 400) {
                        $('#updateImageErrors').html("");
                        $.each(response.errors, function (key, error) {
                            $('#updateImageErrors').append(`${error} `);
                        });
                    } else {
                        location.reload();
                    }
                }
            });
        });
    });

});
</script>

@endsection