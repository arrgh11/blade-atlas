<?php

namespace Arrgh11\Atlas\Livewire\Concerns;

use Arrgh11\Atlas\Livewire\Attributes\Control;

trait InteractsWithControls
{
    public function getControls(): array
    {

        //get the controls attributes from the class, using Reflection
        $reflection = new \ReflectionClass($this);
        $controls = [];

        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Control::class);
            if (count($attributes) > 0) {
                $control = $attributes[0]->newInstance();
                $control->setName($property->getName());
                $controls[] = $control;
            }
        }

        return $controls;

    }

    public function renderControls(): string
    {
        $controls = $this->getControls();

        $controlHtml = '';
        foreach ($controls as $control) {
            $controlHtml .= $control->renderControl();
        }

        return $controlHtml;
    }
}
