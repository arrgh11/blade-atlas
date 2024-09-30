<?php

namespace Arrgh11\Atlas\Livewire\Attributes;

use Arrgh11\Atlas\Enums\Control as ControlEnum;
use Illuminate\Support\Facades\Blade;

#[\Attribute]
class Control
{
    public ControlEnum $controlType = ControlEnum::TEXT;

    public string $name = '';

    public string $label = '';

    public ?string $view = null;

    public array $options = [];

    public function __construct(
        string|ControlEnum $type,
        string $label = '',
        ?string $view = null,
        ?string $name = null,
        array $options = []
    ) {
        $this->controlType = is_string($type) ? ControlEnum::tryFrom($type) : $type;

        $this->label = $label;

        $this->view = $view ? $view : $this->controlType->getView();

        $this->options = $options;

    }

    public function setName(string $name): Control
    {
        $this->name = $name;

        return $this;
    }

    public function renderControl(): string
    {

        return Blade::render('<x-dynamic-component :component="$view" :label="$label" :options="$options" name="{{$name}}" />', [
            'view' => $this->view,
            'label' => $this->label,
            'name' => $this->name,
            'options' => $this->options,
        ]);
    }
}
