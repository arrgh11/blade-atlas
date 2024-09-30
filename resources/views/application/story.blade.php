<x-atlas::application :title="$title">

    {{--    <livewire:atlas-app />--}}
    {{ $slot }}

{{--    @if(!empty($form))--}}
{{--        <x-slot:form>--}}
{{--            {{ $form }}--}}
{{--        </x-slot:form>--}}
{{--    @endif--}}

</x-atlas::application>
