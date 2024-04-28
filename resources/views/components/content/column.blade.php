@props(['size' => 'sm'])

<div class="block col-span-1 px-2
    @if ($size == 'lg') sm:col-span-2 @endif
    @if ($size == 'full') sm:col-span-3 @endif
    @if ($size == 'center') xl:col-span-3 @endif
    ">
    @if ($size == 'center')
        <div class="w-full mx-auto xl:w-1/2">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</div>