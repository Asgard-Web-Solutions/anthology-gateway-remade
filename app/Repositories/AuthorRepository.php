<?php

namespace App\Repositories;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AuthorRepository implements AuthorRepositoryInterface
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

    public function getAllAuthors()
    {
        return Cache::remember('authors:all', $this->resetWeekly, function () {
            return Author::all();
        });
    }

    public function getAuthor($id)
    {
        return Cache::remember('author:id:'.$id, $this->resetWeekly, function () use ($id) {
            return Author::find($id);
        });
    }

    public function updateAuthor($id, array $attributes)
    {
        $author = $this->getAuthor($id);
        $author->update($attributes);

        $this->clearCache($id);

        return $author;
    }

    public function clearCache($id = 0)
    {
        if ($id) {
            Cache::forget('author:id:'.$id);
            Cache::forget('author:id:'.$id.':header');
        } else {
            Cache::forget('authors:countAll');
        }
        
        Cache::forget('authors:all');
    }

    public function countAllAuthors()
    {
        return Cache::remember('authors:countAll', $this->resetWeekly, function () {
            return Author::count();
        });
    }

    public function countNewAuthors()
    {
        return Cache::remember('authors:countNew', $this->resetDaily, function () {
            return Author::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        });
    }
}
