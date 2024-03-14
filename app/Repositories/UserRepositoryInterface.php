<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUser($id);
    public function createUser(array $attributes);
    public function updateUser($id, array $attributes);
    public function countAllUsers();
    public function countNewUsers();
}
