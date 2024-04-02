<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriesPolicy
{
    use HandlesAuthorization;
    public function __construct()
    {
  
    }

    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.category.list-category'));
    }

    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.category.add-category'));
    }

    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.category.edit-category'));
    }

    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.category.delete-category'));
    }
}
