@props([
    'form' => null,
    'title' => null
])

<x-atlas::application.layout>
    <div class="w-full flex relative" >

        @persist('sidebar')
            <x-atlas::application.sidebar />
        @endpersist


        <div class="w-full flex flex-col">

{{--            <x-atlas::application.navbar />--}}

            <div class="flex w-full h-full bg-gray-100">

                <main class="w-full h-full" x-data >

                    <x-atlas::application.toolbar >
                        @php
                            $tools = \Arrgh11\Atlas\Facades\Atlas::getTools();
                        @endphp

                        @foreach($tools as $tool)
                            {{-- @include($tool['view']) --}}
                            <x-dynamic-component :component="$tool['view']" />
                        @endforeach
                    </x-atlas::application.toolbar>


                    <div class="flex flex-col justify-center items-center w-full h-full bg-gray-200 px-4 sm:px-6 lg:px-8" >
                        <div class="bg-gray-100 w-full h-full" x-bind:class="{
                            'max-w-7xl': $store.viewport.size === 'desktop',
                            'max-w-2xl': $store.viewport.size === 'tablet',
                            'max-w-md': $store.viewport.size === 'mobile'
                        }">
                            {{ $slot }}
                        </div>
                    </div>

                </main>

                <x-atlas::application.panel />

            </div>


        </div>
    </div>
</x-atlas::application.layout>
