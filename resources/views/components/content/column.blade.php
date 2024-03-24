@props(['size' => 'sm'])

<div class="block col-span-1 px-2
    @if ($size == 'lg') sm:col-span-2 @endif
    @if ($size == 'full') sm:col-span-3 @endif
    ">

    {{ $slot }}

</div>