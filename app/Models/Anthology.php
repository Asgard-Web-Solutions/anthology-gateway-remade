<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Enums\AnthologyStatus;
use Illuminate\Support\Str;

class Anthology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
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

}
