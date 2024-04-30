@props(['href' => '#', 'icon' => '', 'style' => 'dark'])

@php
    $classes = '';
    switch($style) {
        case 'dark':
            $classes .= 'text-purple-700 hover:text-purple-500';
            break;
        case 'light':
            $classes .= 'text-purple-500 hover:text-purple-700';
            break;
    }
@endphp

<a href="{{ $href }}" class='block cursor-pointer {{ $classes }}'><i class="w-6 pr-1 {{ $icon }}"></i> {{ $slot }}</a>