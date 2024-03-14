<?php

namespace App\Repositories;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class RoleRepository implements RoleRepositoryInterface
{
    private $resetDaily = (60 * 60 * 24);
    private $resetHourly = (60 * 60);

    public function getAll()
    {
        return Role::all();
    }

    public function findById($id)
    {
        return Cache::remember('Role:byId:' + $id, $this->resetHourly, function ($id) {
            Role::find($id);
        });
    }

    public function update($id, array $attributes)
    {
        $Role = $this->findById($id);
        $Role->update($attributes);
        Cache::forget('Role:byId:' + $id);

        return $Role;
    }
}