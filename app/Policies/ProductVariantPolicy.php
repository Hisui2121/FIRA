<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductVariant;

class ProductVariantPolicy
{
    public function stock(User $user, ProductVariant $variant)
    {
        return $user->hasAnyRole(['admin', 'staff']);
    }
}
