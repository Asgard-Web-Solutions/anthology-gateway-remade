@props(['name', 'value' => '', 'required' => false])

<div class="mb-6">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-300">{{ $slot }}</label>
    <input type="text" id="{{ $name }}" name="{{ $name }}" @if($value) value="{{ $value }}" @endif @if ($required) required @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5">
</div>
