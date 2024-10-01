<div class="grid grid-cols-5">
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
            {!! $controlFields !!}
        </x-slot:controls>
        <x-slot:code>
            {{ $code }}
        </x-slot:code>
    </x-atlas::application.panel>
</div>
