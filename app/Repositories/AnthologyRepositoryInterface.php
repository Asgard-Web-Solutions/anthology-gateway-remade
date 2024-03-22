<?php

namespace App\Repositories;

interface AnthologyRepositoryInterface
{
    public function getAllAnthologies();

    public function getAnthology($id);

    public function updateAnthology($id, array $attributes);

    public function clearCache();

    public function countAllAnthologies();

    public function countNewAnthologies();
}
