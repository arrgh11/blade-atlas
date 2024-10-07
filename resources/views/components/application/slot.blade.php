<div class=" w-full h-full" x-bind:class="{
    'max-w-7xl': $store.viewport.size === 'desktop',
    'max-w-2xl': $store.viewport.size === 'tablet',
    'max-w-md': $store.viewport.size === 'mobile'
}">
    {!! $slot !!}
</div>
