<x-products 
    :products="$products" 
    :search="isset($search) ? $search : ''" 
    :searchRoute="route('categories.products.search', $category)" 
    :category="$category" 
/>