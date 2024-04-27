<?php

namespace App\Repositories;

interface SocialRepositoryInterface
{
    public function getAllSocials();

    public function getSocial($id);

    public function updateSocial($id, array $attributes);

    public function clearCache();

    public function countAllSocials();
}
