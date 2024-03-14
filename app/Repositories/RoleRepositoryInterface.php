<?php

namespace App\Repositories;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function getRole($id);
    public function updateRole($id, array $attributes);
}
