<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'biography',
        'website',
        'email',
        'address_street_1',
        'address_street_2',
        'address_city',
        'address_state',
        'address_country',
    ];
}
