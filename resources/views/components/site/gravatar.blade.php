@props(['size' => 64, 'shape' => 'round'])

@php
    $default = 'identicon';
    $rating = 'pg';
    $emailHash = hash('sha256', strtolower(trim($slot)));
    $url = "https://www.gravatar.com/avatar/$emailHash?s=$size&d=$default&r=$rating";
    
    $classes = '';
    switch ($shape) {
        case 'round':
            $classes .= 'rounded-full';
            break;
        case 'square':
            $classes .= 'rounded-lg';
            break;
    }
@endphp

<img src="{{ $url }}" class="border-2 border-collapse border-purple-600 {{ $classes }}" />