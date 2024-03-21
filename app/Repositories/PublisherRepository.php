<?php

namespace App\Repositories;

use App\Models\Publisher;
use Carbon\Carbon;
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
            return Publisher::with(['users', 'socials', 'creator'])->get();
        });
    }

    public function getPublisher($id)
    {
        return Cache::remember('publisher:id:'.$id, $this->resetWeekly, function () use ($id) {
            return Publisher::with(['users', 'socials', 'creator'])->find($id);
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

    public function clearCache($id = 0)
    {
        if ($id) {
            Cache::forget('publisher:id:' . $id);
        } else {
            Cache::forget('publishers:all');
            Cache::forget('publishers:countAll');
        }
    }

    public function countAllPublishers()
    {
        return Cache::remember('publishers:countAll', $this->resetWeekly, function () {
            return Publisher::count();
        });
    }

    public function countNewPublishers()
    {
        return Cache::remember('publishers:countNew', $this->resetDaily, function () {
            return Publisher::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        });
    }

}
