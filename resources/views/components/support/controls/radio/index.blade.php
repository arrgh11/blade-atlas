@props([
    'label' => 'Label',
    'name' => 'location',
    'options' => []
])

<flux:radio.group
    wire:model.live="form.controlBag.{{ $name }}"
    :$label>

    @foreach($options as $value => $label)
        <flux:radio value="{{$value}}" :label="$label" />
    @endforeach
</flux:radio.group>
