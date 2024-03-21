@props(['href' => '#', 'icon' => 'none', 'type' => 'link'])

<?php
    $linkText = ($icon != 'none') ? "<i class='{{ $icon }}'></i> " . $slot : $slot ;
?>

@if($type == 'link')
    <a href="{{ $href }}" class="text-white bg-gray-800 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-4 mt-4">{!! $linkText !!}</a>
@elseif ($type == 'submit')
    <button type='submit' class="text-white bg-gray-800 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-4 mt-4">{!! $linkText !!}</button>
@endif