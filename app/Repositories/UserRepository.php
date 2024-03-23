<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class UserRepository implements UserRepositoryInterface
{
    protected $resetHourly;

    protected $resetDaily;

    protected $resetWeekly;

    public function __construct()
    {
        $this->resetHourly = 60 * 60;
        $this->resetDaily = $this->resetHourly * 24;
        $this->resetWeekly = $this->resetDaily * 7;
    }

    public function getAllUsers()
    {
        return Cache::remember('users:all', $this->resetHourly, function () {
            return User::with(['roles', 'publishers'])->get();
        });
    }

    public function getUser($id)
    {
        return Cache::remember('users:id:'.$id, $this->resetHourly, function () use ($id) {
            return User::with(['publishers', 'anthologies'])->find($id);
        });
    }

    public function createUser(array $attributes)
    {
        return User::create($attributes);
    }

    public function updateUser($id, array $attributes)
    {
        $user = $this->getUser($id);
        $user->update($attributes);

        Cache::forget('users:id:'.$id);
        Cache::forget('users:id:'.$id.':isAdmin');

        return $user;
    }

    public function countAllUsers()
    {
        return Cache::remember('users:countAll', $this->resetDaily, function () {
            return User::count();
        });
    }

    public function countNewUsers()
    {
        return Cache::remember('users:countNew', $this->resetDaily, function () {
            return User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        });
    }

    public function clearCache($id) 
    {
        if ($id) {
            Cache::forget('users:id:' . $id);
        } else {
            Cache::forget('userss:all');
            Cache::forget('userss:countAll');
        }

    }
}
