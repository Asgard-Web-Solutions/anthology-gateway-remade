@props(['heading' => ''])

<p class="">
    @if ($heading) <h3 class="mb-2 font-bold">{{ $heading }}</h3> @endif
    {{ $slot }}
</p>