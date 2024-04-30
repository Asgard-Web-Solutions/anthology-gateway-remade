<?php

namespace App\Policies;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class PublisherPolicy
{
    protected $cacheTime = 60 * 60;

    private function isAdmin(User $user): bool
    {
        return Cache::remember('user:id:'.$user->id.':isAdmin', $this->cacheTime, function () use ($user) {
            return $user->roles()->where('name', 'Admin')->exists();
        });
    }

    public function before(User $user, string $ability): ?bool
    {
        if ($this->isAdmin($user)) {
            return true;
        }

        return null;
    }

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
    public function view(?User $user, Publisher $publisher): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Publisher $publisher): bool
    {
        // return ($publisher->creator == $user->id);
        return $publisher->users->contains($user->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Publisher $publisher): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Publisher $publisher): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Publisher $publisher): bool
    {
        //
    }
}
