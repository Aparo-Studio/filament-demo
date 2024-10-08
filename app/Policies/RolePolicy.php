<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    public function index(User $user): bool
    {
        return $user->can('DEMO_INDEX_USER');
    }

    public function viewAny(User $user): bool
    {
        return $user->can('DEMO_ROLES_INDEX');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->can('DEMO_ROLES_INDEX');
    }

    public function create(User $user): bool
    {
        return $user->can('DEMO_ROLES_CREATE');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->can('DEMO_ROLES_EDIT');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->can('DEMO_ROLES_EDIT');
    }

    public function restore(User $user, Role $role): bool
    {
        return $user->can('DEMO_ROLES_EDIT');
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return $user->can('DEMO_ROLES_EDIT');
    }
}
