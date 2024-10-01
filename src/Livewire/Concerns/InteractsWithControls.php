<?php

namespace Arrgh11\Atlas\Livewire\Concerns;

use Arrgh11\Atlas\ControlBag;
use Arrgh11\Atlas\Livewire\Attributes\Control;
use Livewire\Attributes\Computed;

trait InteractsWithControls
{
    public ?StoryForm $form;

    public ?array $controlBag = null;

    public function getControls(): array
    {
        $controls = [];

        if (! $this->activeStoryClass) {
            return $controls;
        }

        //get the controls attributes from the class, using Reflection
        $reflection = new \ReflectionClass($this->activeStoryClass);
        $activeStory = new $this->activeStoryClass;

        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Control::class);
            if (count($attributes) > 0) {
                $control = $attributes[0]->newInstance();
                $control->setName($property->getName());
                $control->setValue($activeStory->{$property->getName()});
                $controls[] = $control;
            }
        }

        return $controls;

    }

    public function setControls()
    {

        //get the name/value pairs from getControls
        $this->controlBag = collect($this->getControls())->mapWithKeys(function ($control) {
            return [$control->name => $control->value];
        })->toArray();

        //        $controlBag = new ControlBag($controls);
        //        $this->controlBag = $controlBag->all();
    }

    #[Computed]
    public function controlFields(): string
    {
        $controls = $this->getControls();

        $controlHtml = '';
        foreach ($controls as $control) {
            $controlHtml .= $control->renderControl();
        }

        return $controlHtml;
    }

    public function update()
    {
        //update the controlBag
        foreach ($this->form->controlBag as $name => $value) {
            $this->controlBag[$name] = $value;
        }

        //re-render the component
        $this->dispatch('refresh');
    }
}
