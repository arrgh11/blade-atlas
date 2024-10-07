<?php

namespace Arrgh11\Atlas\Controls;

use Arrgh11\Atlas\Contracts\InteractsWithOptions;

class Select extends Control
{
    use InteractsWithOptions;

    public function getView(): string
    {
        return 'atlas::support.controls.select';
    }
}
