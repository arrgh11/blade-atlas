@props([
    'label' => 'Label',
    'name' => 'text',
    'options' => []
])

{{--<div x-id="['text-control']">--}}
{{--    <label x-bind:for="$id('text-control')" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>--}}
{{--    <div class="mt-2">--}}
{{--        <input--}}
{{--            {{ $attributes->class([--}}
{{--                'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'--}}
{{--            ]) }}--}}

{{--            type="text"--}}
{{--            name="text"--}}
{{--            wire:model.live="{{ $name }}"--}}
{{--            x-bind:id="$id('text-control')"--}}
{{--            placeholder="{{ $label }}">--}}
{{--    </div>--}}
{{--</div>--}}

<flux:input
    wire:model="form.controlBag.{{ $name }}"
{{--    wire:model.live="form.test"--}}
    :$label
{{--    description="This will be publicly displayed." --}}
/>
