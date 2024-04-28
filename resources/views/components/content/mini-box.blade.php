@props(['heading' => '', 'href' => ''])

<div class="p-3 mx-2 my-5 text-gray-800 bg-gray-200 rounded-lg w-72">
    @if ($heading) 
        <h3 class="mb-3 text-xl font-bold text-center text-purple-700">
            @if ($href)
                <a href="{{ $href }}" class="underline hover:text-purple-900 hover:no-underline">{{ $heading }}</a>
            @else
                {{ $heading }}
            @endif
        </h3> 
    @endif
    
    {{ $slot }}
</div>