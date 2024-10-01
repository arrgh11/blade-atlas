<?php

namespace Arrgh11\Atlas\Livewire\Concerns;

use Livewire\Form;

class StoryForm extends Form
{

    public string $test = 'test';

    public array $controlBag = [];

    public function fillControlBag(array $controls)
    {

        foreach ($controls as $control) {
            $this->controlBag[$control->name] = $control->value;
        }
    }

}
