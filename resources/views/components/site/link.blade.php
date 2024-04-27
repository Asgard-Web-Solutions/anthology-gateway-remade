@props(['href' => '#', 'icon' => ''])

<a href="{{ $href }}" class='block text-purple-700 cursor-pointer hover:text-purple-500'><i class="w-6 pr-1 {{ $icon }}"></i> {{ $slot }}</a>