<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function countAll();
    public function countNew();
}
