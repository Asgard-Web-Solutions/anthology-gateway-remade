<?php

namespace App\Repositories;

use App\Models\Anthology;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

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

    public function getAnthology($id)
    {
        return Cache::remember('anthology:id:'.$id, $this->resetWeekly, function () use ($id) {
            return Anthology::find($id);
        });
    }

    public function updateAnthology($id, array $attributes)
    {
        $Anthology = $this->getAnthology($id);
        $Anthology->update($attributes);

        Cache::forget('anthology:id:'.$id);
        Cache::forget('anthologies:all');

        return $Anthology;
    }

    public function clearCache($id = 0)
    {
        if ($id) {
            Cache::forget('anthology:id:' . $id);
        } else {
            Cache::forget('anthologies:all');
            Cache::forget('anthologies:countAll');
        }
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
