<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    {{--    <x-atlas::application.logo />--}}

    <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />
    <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="px-2 hidden dark:flex" />

    <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />

    @persist('sidebar')

        {{ $slot }}


{{--        @if(config('atlas.show_tests'))--}}
{{--            <x-atlas::application.sidebar.menu.group title="Tests">--}}
{{--                <x-atlas::application.sidebar.menu.item href="{{route('atlas.story', ['story' => 'test-button'])}}">--}}
{{--                    Test Button--}}
{{--                </x-atlas::application.sidebar.menu.item>--}}
{{--                <x-atlas::application.sidebar.menu.item href="{{route('atlas.story', ['story' => 'test-button-group'])}}">--}}
{{--                    Test Button Group--}}
{{--                </x-atlas::application.sidebar.menu.item>--}}
{{--            </x-atlas::application.sidebar.menu.group>--}}
{{--        @endif--}}
    @endpersist

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist>

    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin" />

        <flux:menu>
            <flux:menu.radio.group>
                <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                <flux:menu.radio>Truly Delta</flux:menu.radio>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
        </flux:menu>
    </flux:dropdown>


</flux:sidebar>
