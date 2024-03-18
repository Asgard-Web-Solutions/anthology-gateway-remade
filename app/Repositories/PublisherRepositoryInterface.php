<?php

namespace App\Repositories;

interface PublisherRepositoryInterface
{
    public function getAllPublishers();

    public function getPublisher($id);

    public function updatePublisher($id, array $attributes);

    public function clearCache();

    public function countAllPublishers();
}
