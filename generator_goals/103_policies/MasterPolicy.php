<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Master;
use Illuminate\Auth\Access\HandlesAuthorization;

class MasterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the master can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list masters');
    }

    /**
     * Determine whether the master can view the model.
     */
    public function view(User $user, Master $model): bool
    {
        return $user->hasPermissionTo('view masters');
    }

    /**
     * Determine whether the master can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create masters');
    }

    /**
     * Determine whether the master can update the model.
     */
    public function update(User $user, Master $model): bool
    {
        return $user->hasPermissionTo('update masters');
    }

    /**
     * Determine whether the master can delete the model.
     */
    public function delete(User $user, Master $model): bool
    {
        return $user->hasPermissionTo('delete masters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete masters');
    }

    /**
     * Determine whether the master can restore the model.
     */
    public function restore(User $user, Master $model): bool
    {
        return false;
    }

    /**
     * Determine whether the master can permanently delete the model.
     */
    public function forceDelete(User $user, Master $model): bool
    {
        return false;
    }
}
