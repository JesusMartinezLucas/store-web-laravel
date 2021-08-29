@component('mail::message')
# El producto que vediste fue devuelto

La venta del producto {{ $product->description }} fue cancelada

@component('mail::button', ['url' => route('products.show', $product)])
    Ver producto
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
