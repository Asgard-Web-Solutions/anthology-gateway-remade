<?php

namespace App\Repositories;

use App\Models\Publisher;
use Illuminate\Support\Facades\Cache;

class PublisherRepository implements PublisherRepositoryInterface
{
    protected $resetHourly;

    protected $resetDaily;

    protected $resetWeekly;

    public function __construct()
    {
        $this->resetHourly = 60 * 60;
        $this->resetDaily = $this->resetHourly * 24;
        $this->resetWeekly = $this->resetDaily * 7;
    }

    public function getAllPublishers()
    {
        return Cache::remember('publishers:all', $this->resetWeekly, function () {
            return Publisher::all();
        });
    }

    public function getPublisher($id)
    {
        return Cache::remember('publisher:id:'.$id, $this->resetWeekly, function () use ($id) {
            return Publisher::find($id);
        });
    }

    public function updatePublisher($id, array $attributes)
    {
        $Publisher = $this->getPublisher($id);
        $Publisher->update($attributes);

        Cache::forget('publisher:id:'.$id);
        Cache::forget('publishers:all');

        return $Publisher;
    }

    public function clearCache()
    {
        Cache::forget('publishers:all');
        Cache::forget('publishers:countAll');
    }

    public function countAllPublishers()
    {
        return Cache::remember('publishers:countAll', $this->resetWeekly, function () {
            return Publisher::count();
        });
    }
}
