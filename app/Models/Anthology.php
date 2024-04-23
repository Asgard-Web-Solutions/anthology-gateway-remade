<?php

namespace App\Models;

use App\Enums\AnthologyStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class Anthology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'publisher_id',
        'about_publishers',
        'distribution',

        'open_date',
        'close_date',
        'end_review_date',
        'est_pub_date',

        'sub_ideal_count',
        'sub_guidelines',
        'sub_min_length',
        'sub_max_length',
        'sub_prefer_anon',

        'msg_accept_text',
        'msg_decline_text',

        'pay_amount',
        'pay_currency',
        'pay_supplemental',

        'status'
    ];

    protected $casts = [
        'status' => AnthologyStatus::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function isFullyConfigured(): bool
    {
        foreach ($this->getAttributes() as $key => $value) {
            if (Str::startsWith($key, 'configured_') && !$value) {
                return false;
            }
        }

        return true;
    }

    public function getCoverAttribute()
    {
        $cacheKey = 'anthology:id:'.$this->id.':cover';
        $resetTime = (60 * 60 * 24 * 7);  // Adjust according to your specific use case

        return Cache::remember($cacheKey, ($resetTime - 5), function () {
            if ($this->cover_image) {
                return Storage::disk('s3')->temporaryUrl($this->cover_image, now()->addDays(7));
            }
            return null;
        });
    }

    public function getHeaderAttribute()
    {
        $cacheKey = 'anthology:id:'.$this->id.':header';
        $resetTime = (60 * 60 * 24 * 7);  // Adjust according to your specific use case

        return Cache::remember($cacheKey, ($resetTime - 5), function () {
            if ($this->header_image) {
                return Storage::disk('s3')->temporaryUrl($this->header_image, now()->addDays(7));
            }
            return null;
        });
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }
}
