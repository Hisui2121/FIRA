<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    // anyone logged in (admin or staff)
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['admin', 'staff']);
    }

    public function view(User $user, Product $product)
    {
        return $user->hasAnyRole(['admin', 'staff']);
    }

    // ADMIN ONLY
    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Product $product)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Product $product)
    {
        return $user->hasRole('admin');
    }

    // STOCK ACTIONS (ADMIN + STAFF)
    public function stock(User $user)
    {
        return $user->hasAnyRole(['admin', 'staff']);
    }
}