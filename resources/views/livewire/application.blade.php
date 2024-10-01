<div class="min-h-screen bg-white dark:bg-zinc-800">
    <x-atlas::application.sidebar>
        <flux:navlist variant="outline">

            @foreach($stories as $group => $storyList)
                <flux:navlist.group expandable heading="{{ $group }}" class="hidden lg:grid">

                    @foreach($storyList as $story)
                        <flux:navlist.item href="#" wire:click.prevent="setActiveStory('{{$story['component']}}')">
                            {{ $story['title'] }}
                        </flux:navlist.item>
                    @endforeach
                </flux:navlist.group>

                {{--                <x-atlas::application.sidebar.menu.group title="{{ $group }}">--}}

                {{--                </x-atlas::application.sidebar.menu.group>--}}
            @endforeach
        </flux:navlist>
    </x-atlas::application.sidebar>

    <x-atlas::application.toolbar >
        {{--            <flux:navbar.item href="#" current>Dashboard</flux:navbar.item>--}}

        @foreach($tools as $tool)
{{--            <x-dynamic-component :component="$tool['view']" />--}}
        @endforeach
    </x-atlas::application.toolbar>

    <main class="[grid-area:main] [[data-flux-container]_&]:px-0 grid grid-cols-5" data-flux-main>

        <div class="col-span-4">
            <div class=" w-full h-full" x-bind:class="{
                'max-w-7xl': $store.viewport.size === 'desktop',
                'max-w-2xl': $store.viewport.size === 'tablet',
                'max-w-md': $store.viewport.size === 'mobile'
            }">
                {!! $slot !!}
            </div>
        </div>

        <x-atlas::application.panel>
            <x-slot:controls>
                {!! $this->controlFields !!}
            </x-slot:controls>
            <x-slot:code>
{{--                {{ $code }}--}}
            </x-slot:code>
        </x-atlas::application.panel>

    </main>
</div>
