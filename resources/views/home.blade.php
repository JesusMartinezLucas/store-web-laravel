@extends('layouts.app')

@section('search')
    <x-search :route="''" :search="''" />
@endsection

@section('content')
    <div class="break-all sm:text-lg md:text-xl flex justify-center">
        
        <div class="bg-white m-6 p-6 rounded-lg">
            <div id="productsContainer" class="grid total-products-container gap-2">
                
            </div>

            <div class="flex justify-between mt-4">
                <h2 class="text-center font-semibold">Total</h2>
                <p id="total" class="text-center font-bold">$0.00</p>
            </div>

        </div>

    </div>
@endsection

@section('scripts')

<script>
    $(document).ready(function () {

        clearData();
        $("#searchField").focus();

        function clearData()
        {
            $('#productsContainer').html(
                '<h2 class="text-center font-semibold">Descripción</h2>\
                <h2 class="text-center font-semibold">Precio</h2>\
                <h2 class="text-center font-semibold">Cant.</h2>\
                <h2 class="text-center font-semibold">Importe</h2>\
                <button type="button" id="clearDataButton" class="bg-white">\
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>\
                </button>');

            $('#total').text('$0.00');
        }

        $(document).on('submit', '#searchForm', function (e) {
            e.preventDefault();

            const data = {
                'search': $('#searchField').val()
            }
 
            $.ajax({
                type: "GET",
                url: "/home/search",
                data: data,
                dataType: "json",
                success: function (response) {

                    $.each(response.products, function (key, product) {

                        const quantityField = $(`input.${product.id}`);

                        if(quantityField.length > 0)
                        {
                            quantityField.val(+quantityField.val() + 1).change();
                        } 
                        else
                        {
                            $('#productsContainer').append(`\
                            <p class="${product.id} text-center">${product.description}</p>\
                            <p class="${product.id} text-center">$${product.price}</p>\
                            <input type="number" value="1" min="0" class="${product.id} quantity w-10 text-center">\
                            <p class="${product.id} amount text-center">$${product.price}</p>\
                            <button type="button" value="${product.id}" id="clearProductButton" class="${product.id} bg-white">\
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>\
                            </button>`);

                            let total = Number($('#total').text().substring(1));
                            total = total + +product.price;
                            $('#total').text(`$${total.toFixed(2)}`);
                        }
                        
                    });

                    $("#searchField").val("");
                    
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
            
            $("#searchField").focus();
        });

        $(document).on('click', '#clearDataButton', function (e) {
            clearData();
            $("#searchField").focus();
        });

        $(document).on('click', '#clearProductButton', function (e) {
            productId = $(this).val();
            $(`input.${productId}`).val(0).change();
            $(`.${productId}`).remove(); 
            $("#searchField").focus();
        });
    });
</script>

@endsection