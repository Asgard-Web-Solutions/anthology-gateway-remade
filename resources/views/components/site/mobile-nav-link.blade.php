@props(['href' => '#', 'icon' => ''])

<a href="{{ $href }}" class='block text-xl'><i class="w-6 pr-1 {{ $icon }}"></i> {{ $slot }}</a>