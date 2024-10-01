@props([
    'label' => 'Label',
    'name' => 'location',
])

<flux:switch wire:model.live="form.controlBag.{{ $name }}" :$label />
