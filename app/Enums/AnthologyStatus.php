<?php

namespace App\Enums;

enum AnthologyStatus: string
{
    case Draft = 'draft';
    case Prelaunch = 'prelaunch';
    case Launched = 'launched';
    case OpenCall = 'open call';
    case SlushPile = 'slush pile';
    case Production = 'production';
    case Published = 'published';
}
