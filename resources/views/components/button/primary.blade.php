@props(['href' => '#', 'icon' => 'none', 'type' => 'link', 'disabled' => false])

<?php
    $linkText = ($icon != 'none') ? "<i class='{{ $icon }}'></i> " . $slot : $slot ;
?>

@if($type == 'link')
    <a href="{{ $href }}" class="text-white @if($disabled) bg-purple-300 cursor-not-allowed @else bg-purple-800 hover:bg-purple-950 @endif  focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mx-2 mb-3 mt-3">{!! $linkText !!}</a>
@elseif ($type == 'submit')
    <button type='submit' @if($disabled) disabled @endif class="text-white bg-purple-800 hover:bg-purple-950 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mx-2 mb-3 mt-3">{!! $linkText !!}</button>
@endif