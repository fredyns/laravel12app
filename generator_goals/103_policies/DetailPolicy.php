<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Detail;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the detail can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list details');
    }

    /**
     * Determine whether the detail can view the model.
     */
    public function view(User $user, Detail $model): bool
    {
        return $user->hasPermissionTo('view details');
    }

    /**
     * Determine whether the detail can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create details');
    }

    /**
     * Determine whether the detail can update the model.
     */
    public function update(User $user, Detail $model): bool
    {
        return $user->hasPermissionTo('update details');
    }

    /**
     * Determine whether the detail can delete the model.
     */
    public function delete(User $user, Detail $model): bool
    {
        return $user->hasPermissionTo('delete details');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete details');
    }

    /**
     * Determine whether the detail can restore the model.
     */
    public function restore(User $user, Detail $model): bool
    {
        return false;
    }

    /**
     * Determine whether the detail can permanently delete the model.
     */
    public function forceDelete(User $user, Detail $model): bool
    {
        return false;
    }
}
