@props([
    'label' => 'Label',
    'name' => 'location',
])

<flux:textarea
    wire:model.live="form.controlBag.{{ $name }}"
    :$label
    placeholder="No lettuce, tomato, or onion..."
/>
