@props(['heading' => '', 'heading_icon' => '', 'style' => 'light', 'href' => ''])

@php
    $headingText = ($heading_icon) ? '<i class="' . $heading_icon . '"></i> ' : '';
    $headingText .= ($heading) ?? '';

    $colorStyle = ($style == 'light') ? 'text-gray-800 bg-gray-200' : 'text-gray-200 bg-gray-500';
    if ($style == 'light') {
        $colorStyle = 'text-gray-800 bg-gray-200';
        $colorHeading = 'text-purple-900';
    } elseif ($style == 'dark') {
        $colorStyle = 'text-gray-200 bg-gray-500';
        $colorHeading = 'text-purple-400';
    }
@endphp

<div class="p-3 my-5 mr-3 {{ $colorStyle }} rounded-lg">
    @if ($heading)
        @if ($href) <a href="{{ $href }}" class="hover:underline">@endif
            <h3 class="mb-3 text-lg {{ $colorHeading }} text-bold">{!! $headingText !!}</h3>
        @if ($href)</a>@endif
    @endif
    
    {{ $slot }}
</div>