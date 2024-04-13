<?php

namespace App\Repositories;

use App\Enums\AnthologyStatus;
use App\Models\Anthology;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AnthologyRepository implements AnthologyRepositoryInterface
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

    public function getAllAnthologies()
    {
        return Cache::remember('anthologies:all', $this->resetWeekly, function () {
            return Anthology::all();
        });
    }

    public function getOpenSoonAnthologies()
    {
        return Cache::remember('anthologies:openSoon', $this->resetDaily, function () {
            $statuses = [AnthologyStatus::Launched, AnthologyStatus::OpenCall];
            return Anthology::whereIn('status', $statuses)->get();
        });
    }

    public function getAnthology($id)
    {
        return Cache::remember('anthology:id:'.$id, $this->resetWeekly, function () use ($id) {
            return Anthology::find($id);
        });
    }

    public function getAnthologyHeader($id)
    {
        return Cache::remember('anthology:id:'.$id.':header', ($this->resetWeekly - 5), function () use ($id) {
            $anthology = $this->getAnthology($id);

            if ($anthology->header_image) {
                return Storage::disk('s3')->temporaryUrl($anthology->header_image, now()->addDays(7));
            } else {
                return null;
            }
        });
    }

    public function getAnthologyCover($id)
    {
        return Cache::remember('anthology:id:'.$id.':cover', ($this->resetWeekly - 5), function () use ($id) {
            $anthology = $this->getAnthology($id);

            if ($anthology->cover_image) {
                return Storage::disk('s3')->temporaryUrl($anthology->cover_image, now()->addDays(7));
            } else {
                return null;
            }
        });
    }

    public function updateAnthology($id, array $attributes)
    {
        $anthology = $this->getAnthology($id);
        $anthology->update($attributes);

        $this->clearCache($id);

        return $anthology;
    }

    public function clearCache($id = 0)
    {
        if ($id) {
            Cache::forget('anthology:id:'.$id);
            Cache::forget('anthology:id:'.$id.':header');
        } else {
            Cache::forget('anthologies:countAll');
        }
        
        Cache::forget('anthologies:all');
        Cache::forget('anthologies:openSoon');
    }

    public function countAllAnthologies()
    {
        return Cache::remember('anthologies:countAll', $this->resetWeekly, function () {
            return Anthology::count();
        });
    }

    public function countNewAnthologies()
    {
        return Cache::remember('anthologies:countNew', $this->resetDaily, function () {
            return Anthology::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        });
    }
}
