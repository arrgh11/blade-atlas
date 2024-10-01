@props([
    'label' => 'Label',
    'name' => 'location',
    'options' => []
])

<flux:select
    wire:model.blur="form.controlBag.{{ $name }}"
    :$label
    placeholder="Choose industry..."
>
    @foreach($options as $value => $label)
        <option value="{{$value}}">{{ $label }}</option>
    @endforeach
</flux:select>
