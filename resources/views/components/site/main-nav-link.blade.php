@props(['href' => '#', 'icon' => ''])

<a href="{{ $href }}" class='block text-gray-400 cursor-pointer hover:text-gray-300'><i class="w-6 pr-1 {{ $icon }}"></i> {{ $slot }}</a>