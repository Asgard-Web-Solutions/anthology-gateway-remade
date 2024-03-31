@props(['heading' => 'Heading', 'size' => 'full'])


<div class="p-5 mx-auto my-5 text-gray-300 bg-gray-900 rounded-md shadow-sm
    @if ($size == 'full') w-full @endif
    @if ($size == 'half') w-1/2 @endif
    @if ($size == 'large') w-3/4 @endif
">
    <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{!! $heading !!}</h2>

    {{ $slot }}
</div>