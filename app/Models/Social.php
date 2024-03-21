<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Social extends Model
{
    protected $fillable = [
        'name',
        'image',
        'base_url',
    ];

    use HasFactory;

    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Publisher::class)->withPivot('url')->withTimestamps();
    }
}
