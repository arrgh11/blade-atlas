<?php

namespace Arrgh11\Atlas\Tools;

class Viewport extends Tool
{
    //Blade view
    protected static string $view = 'atlas::components.application.tools.viewport.index';

    //Alpine component
    protected static string $component = <<<'JS'
Alpine.store('viewport', {
    size: 'desktop',
    changeViewport(size) {
        this.size = size
    }
})
JS;
}
