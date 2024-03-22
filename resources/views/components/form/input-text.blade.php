@props(['name', 'value' => '', 'required' => false, 'placeholder' => ''])

<div class="mb-6">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-300">{{ $slot }}</label>
    <input type="text" id="{{ $name }}" name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5
        @error($name) border-red-500 @enderror"
    >
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror   
</div>

