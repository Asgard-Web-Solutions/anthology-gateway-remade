<?php

namespace App\Repositories;

use App\Models\Social;
use Illuminate\Support\Facades\Cache;

class SocialRepository implements SocialRepositoryInterface
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

    public function getAllSocials()
    {
        return Cache::remember('socials:all', $this->resetWeekly, function () {
            return Social::all();
        });
    }

    public function getSocial($id)
    {
        return Cache::remember('social:id:'.$id, $this->resetWeekly, function () use ($id) {
            return Social::find($id);
        });
    }

    public function updateSocial($id, array $attributes)
    {
        $Social = $this->getSocial($id);
        $Social->update($attributes);

        Cache::forget('social:id:'.$id);
        Cache::forget('socials:all');

        return $Social;
    }

    public function clearCache()
    {
        Cache::forget('socials:all');
        Cache::forget('socials:countAll');
    }

    public function countAllSocials()
    {
        return Cache::remember('socials:countAll', $this->resetWeekly, function () {
            return Social::count();
        });
    }
}
