<?php

namespace Arrgh11\Atlas\Livewire\Tests;

use Arrgh11\Atlas\Enums\Control as ControlType;
use Arrgh11\Atlas\Livewire\Attributes\Control;
use Arrgh11\Atlas\Livewire\Story;
use Livewire\Attributes\Layout;

#[Layout('atlas::application.story')]
class Button extends Story
{
    #[Control(ControlType::TEXT, 'Button Text')]
    public string $text = 'Button Text';

    #[Control(
        type: ControlType::SELECT,
        label: 'Button Size',
        options: [
            'xs' => 'Extra Small',
            'sm' => 'Small',
            'md' => 'Medium',
            'lg' => 'Large',
            'xl' => 'Extra Large',
        ]
    )]
    public string $size = 'xs'; //xs, sm, md, lg, xl

    protected string $view = 'atlas::livewire.tests.button';
}
