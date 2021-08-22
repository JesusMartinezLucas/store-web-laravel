<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function deleteLastSale(User $user, Product $product)
    {
        return $product->sales->count() && $user->id === $product->sales()->orderBy('id', 'desc')->first()->user_id;
    }
}
