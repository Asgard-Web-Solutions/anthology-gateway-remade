@props(['email' => ''])

@php
    $size = 64;
    $default = 'identicon';
    $rating = 'pg';
    $emailHash = hash('sha256', strtolower(trim($email)));
    $url = "https://www.gravatar.com/avatar/$emailHash?s=$size&d=$default&r=$rating";
@endphp

<div class="">
    <img src="{{ $url }}" />
</div>