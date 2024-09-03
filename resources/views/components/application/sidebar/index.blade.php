<!-- Static sidebar for desktop -->
<div class="flex w-72 flex-col h-full">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">
        <div class="flex h-16 shrink-0 items-center">
            <x-wirebook::application.logo />
        </div>
        <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>

                    @php
                        $stories = \Arrgh11\WireBook\Facades\WireBook::getStories();
                    @endphp

                    @foreach($stories as $group => $storyList)
                        <x-wirebook::application.sidebar.menu.group title="{{ $group }}">
                            @foreach($storyList as $story)
                                <x-wirebook::application.sidebar.menu.item href="{{route('wirebook.story', ['story' => $story['route']])}}">
                                    {{ $story['title'] }}
                                </x-wirebook::application.sidebar.menu.item>
                            @endforeach
                        </x-wirebook::application.sidebar.menu.group>
                    @endforeach

                    @if(config('wirebook.show_tests'))
                        <x-wirebook::application.sidebar.menu.group title="Tests">
                            <x-wirebook::application.sidebar.menu.item href="{{route('wirebook.story', ['story' => 'test-button'])}}">
                                Test Button
                            </x-wirebook::application.sidebar.menu.item>
                            <x-wirebook::application.sidebar.menu.item href="{{route('wirebook.story', ['story' => 'test-button-group'])}}">
                                Test Button Group
                            </x-wirebook::application.sidebar.menu.item>
                        </x-wirebook::application.sidebar.menu.group>
                    @endif

                </li>

                <li class="mt-auto">
                    <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                        <x-heroicon-o-cog-6-tooth class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" />
                        Settings
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
