<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    public function index(User $user): bool
    {
       return true;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Permission $permission): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Permission $permission): bool
    {
        return true;
    }

    public function delete(User $user, Permission $permission): bool
    {
        return true;
    }

    public function restore(User $user, Permission $permission): bool
    {
        return true;
    }

    public function forceDelete(User $user, Permission $permission): bool
    {
        return true;
    }
}
