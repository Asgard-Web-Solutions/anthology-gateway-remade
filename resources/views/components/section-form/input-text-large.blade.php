@props(['name', 'value' => '', 'required' => false, 'placeholder' => '', 'description' => ''])

<div class="grid grid-cols-1 mb-6 xl:grid-cols-6">
    <div class="flex items-center h-12 col-span-1 mx-auto my-auto text-center xl:text-left">
        <label for="{{ $name }}" class="text-sm font-medium text-gray-900">{{ $slot }}</label>
    </div>
    <div class="col-span-1 xl:col-span-5">
        <p class="my-3 text-sm text-gray-500">{{ $description }}</p>

        <textarea type="text" id="{{ $name }}" name="{{ $name }}" rows="8"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif
            class="bg-gray-50 border mt-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5
            @error($name) border-red-500 @enderror"
        >{{ old($name, $value) }}</textarea>
        @error($name)
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>