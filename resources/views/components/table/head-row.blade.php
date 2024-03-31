@props(['left' => false, 'right' => false])

<th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light @if ($left) rounded-tl @endif @if ($right) rounded-tr @endif">{{ $slot }}</th>
