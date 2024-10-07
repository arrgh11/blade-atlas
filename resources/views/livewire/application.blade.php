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

        <flux:radio.group x-model="$store.viewport.size">
            <flux:button.group>
                <flux:radio value="mobile">
                    <flux:button icon="device-phone-mobile"></flux:button>
                </flux:radio>
                <flux:radio value="tablet">
                    <flux:button icon="device-tablet"></flux:button>
                </flux:radio>
                <flux:radio value="desktop">
                    <flux:button icon="computer-desktop"></flux:button>
                </flux:radio>

            </flux:button.group>
        </flux:radio.group>


        @foreach($tools as $tool)
{{--            <x-dynamic-component :component="$tool['view']" />--}}
        @endforeach
    </x-atlas::application.toolbar>

    <main class="[grid-area:main] [[data-flux-container]_&]:px-0 grid grid-cols-5" data-flux-main>

        <div class="col-span-4 bg-zinc-100 dark:bg-zinc-800" style="height: calc(100vh - 55px); overflow-y: scroll;" wire:replace>
            <x-atlas::application.slot>
                {!! $slot !!}
            </x-atlas::application.slot>
        </div>

        <x-atlas::application.panel class="col-span-1" style="height: calc(100vh - 55px); overflow-y: scroll;">
            <x-slot:controls>
                {!! $this->controlFields !!}
            </x-slot:controls>
            <x-slot:code>
                {{--                {{ $code }}--}}
            </x-slot:code>
        </x-atlas::application.panel>

    </main>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('viewport', {
                size: 'desktop',

                changeViewport(size) {
                    this.size = size;
                }
            })
        })
    </script>
</div>
