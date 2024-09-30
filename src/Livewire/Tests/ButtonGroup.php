<?php

namespace Arrgh11\Atlas\Livewire\Tests;

use Arrgh11\Atlas\Livewire\Story;
use Livewire\Attributes\Layout;

#[Layout('atlas::application.story')]
class ButtonGroup extends Story
{
    public string $buttonText = 'Button Text';

    public bool $middle = false;

    protected string $view = 'atlas::livewire.tests.button-group';
}
