<?php

namespace App\Policies;

use App\Models\Anthology;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnthologyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Anthology $anthology): bool
    {
        // Any user can view an anthology project
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Any user is allowed to create an anthology
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Anthology $anthology): bool
    {
        // DONE: Update this security rule to only allow appropriate users
        return ($anthology->users->contains($user->id)) ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Anthology $anthology): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Anthology $anthology): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Anthology $anthology): bool
    {
        //
    }
}
