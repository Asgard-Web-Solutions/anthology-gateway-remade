@props(['href' => '#', 'icon' => 'none', 'type' => 'link'])

<?php
    $linkText = ($icon != 'none') ? "<i class='{{ $icon }}'></i> " . $slot : $slot ;
?>

@if($type == 'link')
    <a href="{{ $href }}" class="text-white bg-red-700 hover:bg-red-950 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mx-2">{!! $linkText !!}</a>
@elseif ($type == 'submit')
    <button type='submit' class="text-white bg-red-700 hover:bg-red-950 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mx-2">{!! $linkText !!}</button>
@endif