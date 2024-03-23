@props(['heading' => 'Heading'])


<div class="w-full p-5 my-5 text-gray-300 bg-gray-900 rounded-md shadow-sm">
    <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{!! $heading !!}</h2>

    {{ $slot }}
</div>