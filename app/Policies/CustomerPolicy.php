<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Customer');
    }

    public function view(User $user, Customer $Customer): bool
    {
        return $user->can('View Customer');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Customer');
    }

    public function update(User $user, Customer $Customer): bool
    {
        return $user->can('Edit Customer');
    }

    public function delete(User $user, Customer $Customer): bool
    {
        return $user->can('Delete Customer');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('Delete Customer');
    }

    public function restore(User $user, Customer $Customer): bool
    {
        return $user->can('Delete Customer');
    }

    public function forceDelete(User $user, Customer $Customer): bool
    {
        return $user->can('Delete Customer');
    }
}
