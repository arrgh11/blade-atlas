<aside class="block bg-gray-100 w-96 overflow-y-auto border-l border-gray-200 px-4 py-6 sm:px-6 lg:px-8">

    <x-atlas::support.tabs>
        <x-slot:list>
            <x-atlas::support.tabs.item>
                Controls
            </x-atlas::support.tabs.item>
            <x-atlas::support.tabs.item>
                Source
            </x-atlas::support.tabs.item>
        </x-slot:list>

        <x-atlas::support.tabs.panel class="py-8 px-4">
            <div  id="controls" >

            </div>
        </x-atlas::support.tabs.panel>



        <x-atlas::support.tabs.panel>
            <pre class="overflow-y-auto">
                <code class="language-html" id="code"></code>
            </pre>
        </x-atlas::support.tabs.panel>

    </x-atlas::support.tabs>

</aside>
