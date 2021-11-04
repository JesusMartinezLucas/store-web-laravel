<x-products 
    :products="$products" 
    :search="isset($search) ? $search : ''" 
    :searchRoute="route('products.search')" 
/>