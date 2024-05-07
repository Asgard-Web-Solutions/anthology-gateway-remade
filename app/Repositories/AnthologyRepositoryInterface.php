<?php

namespace App\Repositories;

interface AnthologyRepositoryInterface
{
    public function getAllAnthologies();

    public function getOpenSoonAnthologies();

    public function getAnthology($id);

    public function getAnthologyHeader($id);

    public function getAnthologyCover($id);

    public function updateAnthology($id, array $attributes);

    public function clearCache();

    public function countAllAnthologies();

    public function countNewAnthologies();

    public function getBookmarkCount($id);

    public function clearBookmarkCount($id);
}
