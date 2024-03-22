@props(['heading' => ''])

<div class="p-3 my-5 text-gray-800 bg-gray-200 rounded-lg">
    @if ($heading) <h3 class="mb-3 text-lg text-purple-800 text-bold">{{ $heading }}</h3> @endif
    
    {{ $slot }}
</div>