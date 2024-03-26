<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

        'header_image',
        'cover_image',

        'sub_ideal_count',
        'sub_guidelines',
        'sub_min_length',
        'sub_max_length',
        'sub_prefer_anon',

        'msg_accept_text',
        'msg_decline_text',

        'pay_amount',
        'pay_currency',
        'pay_supplemental'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
    }
}
