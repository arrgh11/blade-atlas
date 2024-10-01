
@props(['controls' => null, 'code' => null])

<aside class="block w-full overflow-y-auto bg-zinc-50 dark:bg-zinc-900 border-l border-zinc-200 dark:border-zinc-700">

    <flux:tab.group >
        <div class="w-full flex items-center justify-center">
            <flux:tabs variant="segmented" class="mx-auto">
                <flux:tab name="controls">Controls</flux:tab>
                <flux:tab name="source">Source</flux:tab>
            </flux:tabs>
        </div>

        <flux:tab.panel name="controls">
            <form wire:submit="update" class="px-8 space-y-4">

                {{ $controls }}

                <flux:button type="submit" variant="primary">Update</flux:button>
            </form>
        </flux:tab.panel>
        <flux:tab.panel name="source">

            <pre class="overflow-y-auto">
                {{ $code }}
            </pre>
        </flux:tab.panel>
    </flux:tab-group>

</aside>
