<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Cache;

class UserPolicy
{
    protected $cacheTime = 60 * 60;
    private function isAdmin(User $user): bool
    {
        return Cache::remember('user:id:' . $user->id . ':isAdmin', $this->cacheTime, function() use ($user) {
            return ($user->roles()->where('name', 'Admin')->exists());
        });
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return ($this->isAdmin($user)) ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        return ($this->isAdmin($user)) ? Response::allow() : Response::denyAsNotFound();

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return ($this->isAdmin($user)) ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        return ($this->isAdmin($user)) ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        return ($this->isAdmin($user)) ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): Response
    {
        return ($this->isAdmin($user)) ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): Response
    {
        return ($this->isAdmin($user)) ? Response::allow() : Response::denyAsNotFound();
    }
}
