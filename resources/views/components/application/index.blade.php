@props([
    'form' => null,
    'title' => null,
    'controls' => null,
])

<x-atlas::application.layout>

    <x-atlas::application.sidebar />

    <x-atlas::application.toolbar >

        {{--            <flux:navbar.item href="#" current>Dashboard</flux:navbar.item>--}}

        @php
            $tools = \Arrgh11\Atlas\Facades\Atlas::getTools();
        @endphp

        @foreach($tools as $tool)
            {{--                <x-dynamic-component :component="$tool['view']" />--}}
        @endforeach
    </x-atlas::application.toolbar>

    <flux:main class="grid grid-cols-5">

        <div class="col-span-4">
            <div class="bg-gray-100 w-full h-full" x-bind:class="{
                'max-w-7xl': $store.viewport.size === 'desktop',
                'max-w-2xl': $store.viewport.size === 'tablet',
                'max-w-md': $store.viewport.size === 'mobile'
            }">
                {{ $slot }}
            </div>
        </div>

{{--        <div class="flex flex-col justify-center items-center w-full h-full bg-gray-200 px-4 sm:px-6 lg:px-8" >--}}
{{--            --}}
{{--        </div>--}}
        <x-atlas::application.panel>
            <x-slot:controls>
                {!! $controls !!}
            </x-slot:controls>
            <x-slot:code>
                {{ $code }}
            </x-slot:code>
        </x-atlas::application.panel>

    </flux:main>

{{--    <div class="w-full flex relative" >--}}

{{--        @persist('sidebar')--}}
{{--            <x-atlas::application.sidebar />--}}
{{--        @endpersist--}}


{{--        <div class="w-full flex flex-col">--}}

{{--            <div class="flex w-full h-full bg-gray-100">--}}

{{--                <main class="w-full h-full" x-data >--}}

{{--                    <x-atlas::application.toolbar >--}}
{{--                        @php--}}
{{--                            $tools = \Arrgh11\Atlas\Facades\Atlas::getTools();--}}
{{--                        @endphp--}}

{{--                        @foreach($tools as $tool)--}}
{{--                            <x-dynamic-component :component="$tool['view']" />--}}
{{--                        @endforeach--}}
{{--                    </x-atlas::application.toolbar>--}}

{{--                </main>--}}



{{--            </div>--}}


{{--        </div>--}}
{{--    </div>--}}
</x-atlas::application.layout>
