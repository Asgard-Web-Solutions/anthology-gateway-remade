<?php

namespace App\Repositories;

interface AuthorRepositoryInterface
{
    public function getAllAuthors();

    public function getAuthor($id);

    public function updateAuthor($id, array $attributes);

    public function clearCache();

    public function countAllAuthors();

    public function countNewAuthors();
}
