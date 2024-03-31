@props(['href' => '#', 'icon' => 'none', 'type' => 'link'])

<?php
    $linkText = ($icon != 'none') ? "<i class='{{ $icon }}'></i> " . $slot : $slot ;
?>

@if($type == 'link')
    <a href="{{ $href }}" class="px-2 py-1 text-sm text-white bg-purple-800 rounded hover:bg-purple-950 focus:outline-none focus:shadow-outline">{!! $linkText !!}</a>
@elseif ($type == 'submit')
    <button type='submit' class="px-2 py-1 text-sm text-white bg-purple-800 rounded hover:bg-purple-950 focus:outline-none focus:shadow-outline">{!! $linkText !!}</button>
@endif