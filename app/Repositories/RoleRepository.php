<?php

namespace App\Repositories;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class RoleRepository implements RoleRepositoryInterface
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

    public function getAllRoles()
    {
        return Cache::remember('roles:all', $this->resetDaily, function () {
            return Role::all();
        });
    }

    public function getRole($id)
    {
        return Cache::remember('role:id:' + $id, $this->resetWeekly, function() use ($id) {
            return Role::find($id);
        });
    }

    public function updateRole($id, array $attributes)
    {
        $Role = $this->getRole($id);
        $Role->update($attributes);
        Cache::forget('role:id:' + $id);

        return $Role;
    }
}