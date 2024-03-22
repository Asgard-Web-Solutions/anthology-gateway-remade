@props(['size' => 'sm'])

<div class="block col-span-1 px-2
    @if ($size == 'lg') sm:col-span-2 @endif
    ">

    {{ $slot }}

</div>