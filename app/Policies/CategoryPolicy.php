<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    // Anyone logged in (admin or staff) can view categories
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['admin', 'staff']);
    }

    public function view(User $user, Category $category)
    {
        return $user->hasAnyRole(['admin', 'staff']);
    }

    // ADMIN ONLY — create/update/delete
    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Category $category)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Category $category)
    {
        return $user->hasRole('admin');
    }
}