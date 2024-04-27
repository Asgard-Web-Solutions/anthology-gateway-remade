@props(['href' => '#', 'icon' => 'none', 'type' => 'link', 'disabled' => false, 'color' => 'purple'])

<?php
    $linkText = ($icon != 'none') ? "<i class='{{ $icon }}'></i> " . $slot : $slot ;
    $mainColor = 'bg-purple-800';
    $hoverColor = 'hover:bg-purple-950';

    if ($color == 'blue') {
        $mainColor = 'bg-blue-500';
        $hoverColor = 'hover:bg-blue-700';
    }
?>

@if($type == 'link')
    <a href="{{ $href }}" class="text-white @if($disabled) bg-blue-300 cursor-not-allowed @else {{ $mainColor }} {{ $hoverColor }} @endif inline-block focus:ring-4 focus:outline-none  duration-300 transition font-semibold rounded-lg text-lg w-full sm:w-auto px-8 py-3 text-center mx-2 mb-3 mt-3">{!! $linkText !!}</a>
@elseif ($type == 'submit')
    <button type='submit' @if($disabled) disabled @endif class="w-full px-8 py-3 mx-2 mt-3 mb-3 text-lg font-semibold text-center text-white transition duration-300 {{ $mainColor }} rounded-lg {{ $hoverColor }} focus:ring-4 focus:outline-none sm:w-auto">{!! $linkText !!}</button>
@endif