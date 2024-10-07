@props([
    'label' => null,
    'fields' => null,
])

<flux:fieldset>
    <flux:accordion>
        <flux:accordion.item>
            <flux:accordion.heading>{{ $label ?? 'Fieldset' }}</flux:accordion.heading>

            <flux:accordion.content>
                <div class="space-y-6">
                    @if($fields)
                        {!! $fields !!}
                    @endif
                </div>
            </flux:accordion.content>
        </flux:accordion.item>
    </flux:accordion>
</flux:fieldset>
