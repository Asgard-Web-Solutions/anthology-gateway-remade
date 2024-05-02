@props(['href' => '#', 'bookmarked' => false, 'anthology' => ''])

<?php
    $route = ($bookmarked) ? route('anthology.unbookmark') : route('anthology.bookmark');
    $icon = ($bookmarked) ? config('ag.icons.bookmarked') : config('ag.icons.unbookmarked');
?>
<form action="{{ $route }}" method="POST">
    @csrf
    <input type='hidden' name='anthology_id' value='{{ $anthology }}' />
    <button type='submit' class="w-full px-3 py-2 mt-4 mb-4 text-sm font-medium text-center text-white bg-gray-600 rounded-lg hover:bg-gray-950 focus:ring-2 focus:outline-none focus:ring-gray-300 sm:w-auto"><i class='{{ $icon }}'></i></button>
</form>