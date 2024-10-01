@aware([
    'title' => null
])

{{--<aside class="w-full py-4 border-b sticky top-0 bg-gray-100">--}}
{{--    <div class="flex flex-wrap items-center gap-6 px-4 sm:flex-nowrap sm:px-6 lg:px-8">--}}
{{--        <h1 class="text-base font-semibold leading-7 text-gray-900">--}}
{{--            {{ $title }}--}}
{{--        </h1>--}}
{{--    </div>--}}
{{--</aside>--}}

<flux:header data-role="toolbar" class="!block bg-white lg:bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700" wire:ignore>
    <flux:navbar class="lg:hidden w-full">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="start">
            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />

            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                    <flux:menu.radio>Truly Delta</flux:menu.radio>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>


    <flux:navbar scrollable>
        @persist('toolbar')

        {{ $slot }}

        @endpersist
    </flux:navbar>
</flux:header>
