<x-atlas::application :title="$title">

    {{ $slot }}

    <form wire:submit="save">
    {!! $controls ?? '' !!}

        <button type="submit">Save</button>
    </form>

{{--    <x-slot:controls>--}}

{{--        @dump($form)--}}

{{--        {!! $controls ?? '' !!}--}}
{{--    </x-slot:controls>--}}

    <x-slot:code>
        {{ $code ?? '' }}
    </x-slot:code>

</x-atlas::application>
