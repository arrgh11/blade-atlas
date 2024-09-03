@aware([
    'title' => null
])

<aside data-role="toolbar" class="w-full py-4 border-b sticky top-0 bg-gray-100">
    <div class="flex flex-wrap items-center gap-6 px-4 sm:flex-nowrap sm:px-6 lg:px-8">
        <h1 class="text-base font-semibold leading-7 text-gray-900">
            {{ $title }}
        </h1>

        @persist('toolbar')

            {{ $slot }}

        @endpersist

{{--        <a href="#" class="ml-auto flex items-center gap-x-1 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">--}}
{{--            <svg class="-ml-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                <path d="M10.75 6.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" />--}}
{{--            </svg>--}}
{{--            New invoice--}}
{{--        </a>--}}
    </div>
</aside>
