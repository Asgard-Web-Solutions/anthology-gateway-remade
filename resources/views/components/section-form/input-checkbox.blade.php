@props(['name', 'value' => '', 'required' => false, 'placeholder' => '', 'description' => ''])

<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-300">{{ $slot }}</label>
    <p class="my-3 text-sm text-gray-500">{{ $description }}</p>
    <input type="checkbox" id="{{ $name }}" name="{{ $name }}"
        @if (old($name, $value)) checked @endif
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        class="bg-gray-400 border mt-2 border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-12 p-2.5
        @error($name) border-red-500 @enderror"
    >
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror   
</div>

