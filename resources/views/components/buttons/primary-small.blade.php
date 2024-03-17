@props(['href' => '#', 'icon' => ''])

<?php
    $linkText = ($icon != '') ? "<i class='{{ $icon }}'></i> " . $slot : $slot ;
?>

<a href="{{ $href }}" class="px-2 py-1 text-sm text-white bg-purple-800 rounded hover:bg-purple-950 focus:outline-none focus:shadow-outline">{!! $linkText !!}</a>