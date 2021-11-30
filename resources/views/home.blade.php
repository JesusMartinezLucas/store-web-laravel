@extends('layouts.app')

@section('search')
    <x-search :route="''" :search="''" />
@endsection

@section('content')
    <div class="flex justify-center">
        
        <div class="bg-blue-400 m-6 p-6 rounded-lg">
            <div id="productsContainer" class="bg-green-400 grid total-products-container gap-2">
                <h2 class="bg-white text-center font-semibold">Descripción</h2>
                <h2 class="bg-white text-center font-semibold">Precio</h2>
                <h2 class="bg-white text-center font-semibold">Cant.</h2>
                <h2 class="bg-white text-center font-semibold">Importe</h2>
                <button type="button" class="bg-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="bg-green-400 flex justify-between mt-4">
                <h2 class="bg-white text-center font-semibold">Total</h2>
                <p id="total" class="bg-white text-center font-bold">$0.00</p>
            </div>

        </div>

    </div>
@endsection

@section('scripts')

<script>
    $(document).ready(function () {

        $(document).on('submit', '#searchForm', function (e) {
            e.preventDefault();

            const data = {
                'search': $('#searchInput').val()
            }
 
            $.ajax({
                type: "GET",
                url: "/home/search",
                data: data,
                dataType: "json",
                success: function (response) {
                    let total = $('#total').text().substring(1);

                    $.each(response.products, function (key, product) {
                        $('#productsContainer').append('\
                            <p class="bg-white text-center">'+ product.description +'</p>\
                            <p class="bg-white text-center">$'+ product.price +'</p>\
                            <input type="number" value="1" min="0" class="quantity w-10 bg-white text-center">\
                            <p class="amount bg-white text-center">$'+ product.price +'</p>\
                            <button type="button" value="'+ product.id +'" class="bg-white">\
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>\
                            </button>');

                        total = +total + +product.price;
                    });

                    $('#total').text(`$${total.toFixed(2)}`);
                }
            });
        });

        $(document).on('change', '.quantity', function (e) {
            e.preventDefault();

            const quantity = $(this).val();
            const price = $(this).prev().text().substring(1);

            const oldAmount = $(this).next().text().substring(1);
            const newAmount = price * quantity;

            $(this).next().text(`$${newAmount.toFixed(2)}`);

            const oldTotal = $('#total').text().substring(1);
            const newTotal = +oldTotal + (newAmount - +oldAmount);
            $('#total').text(`$${newTotal.toFixed(2)}`);
        });

    });
</script>

@endsection