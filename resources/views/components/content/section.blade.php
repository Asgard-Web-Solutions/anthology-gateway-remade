@props(['heading' => '', 'heading_icon' => ''])

@php
    $headingText = ($heading_icon) ? '<i class="' . $heading_icon . '"></i> ' : '';
    $headingText .= ($heading) ?? '';
@endphp

<div class="p-3 my-5 text-gray-800 bg-gray-200 rounded-lg">
    @if ($heading) <h3 class="mb-3 text-lg text-red-900 text-bold">{!! $headingText !!}</h3> @endif
    
    {{ $slot }}
</div>