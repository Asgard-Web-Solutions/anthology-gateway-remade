<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class UserRepository implements UserRepositoryInterface
{
    private $resetDaily = (60 * 60 * 24);
    private $resetHourly = (60 * 60);

    public function getAll()
    {
        return User::all();
    }

    public function findById($id)
    {
        return Cache::remember('user:byId:' + $id, $this->resetHourly, function ($id) {
            User::find($id);
        });
    }

    public function create(array $attributes)
    {
        return User::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $user = $this->findById($id);
        $user->update($attributes);
        Cache::forget('user:byId:' + $id);

        return $user;
    }

    public function countAll()
    {
        return Cache::remember('user:countAll', $this->resetDaily, function () {
            return User::count();
        });
    }

    public function countNew()
    {
        return Cache::remember('user:countNew', $this->resetDaily, function () {
            return User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        });
    }
}