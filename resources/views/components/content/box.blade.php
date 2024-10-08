@props(['heading' => '', 'heading_icon' => '', 'size' => 'full'])

@php
    $headingText = ($heading_icon) ? '<i class="' . $heading_icon . '"></i> ' : '';
    $headingText .= ($heading) ?? '';
@endphp


<div class="p-5 mx-auto my-5 text-gray-300 bg-gray-900 rounded-md shadow-sm
    @if ($size == 'full') w-full @endif
    @if ($size == 'half') w-1/2 @endif
    @if ($size == 'large') w-3/4 @endif
">
    @if ($heading) <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{!! $headingText !!}</h2>@endif

    {{ $slot }}
</div>