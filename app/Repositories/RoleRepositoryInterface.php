<?php

namespace App\Repositories;

interface RoleRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function update($id, array $attributes);
}
