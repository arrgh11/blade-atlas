<?php

namespace Arrgh11\Atlas\Livewire\Attributes;

use Arrgh11\Atlas\Enums\Control as ControlEnum;
use Closure;
use Attribute;
use Illuminate\Support\Facades\Blade;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Control
{
    public ControlEnum $controlType = ControlEnum::TEXT;

    public string $name = '';

    public string $label = '';

    public ?string $view = null;

    public mixed $value = null;

    public array $options = [];

    public array $fields = [];

    public function __construct(
        string|ControlEnum $type,
        string $label = '',
        ?string $view = null,
        ?string $name = null,
        array|Closure $options = [],
        array|Closure $fields = []
    ) {
        $this->controlType = is_string($type) ? ControlEnum::tryFrom($type) : $type;

        $this->label = $label;

        $this->view = $view ? $view : $this->controlType->getView();

        // dd($options);

        //if $options is a closure, call it and set the result to $options
        if ($options instanceof Closure) {
            $this->options = $options();
        } else {
            $this->options = $options;
        }

        //add the fields
        if ($fields instanceof Closure) {
            $this->fields = $fields();
        } else {
            $this->fields = $fields;
        }


    }

    public function setName(string $name): Control
    {
        $this->name = $name;

        return $this;
    }

    public function setValue(mixed $value): Control
    {
        $this->value = $value;

        return $this;
    }

    public function renderControl(): string
    {

        $fields = '';

        //if the type is a fieldset, render the fields
        if ($this->controlType === ControlEnum::FIELDSET) {
            $fields = collect($this->fields)->map(function ($field) {
                return $field->renderControl();
            })->implode('');
        }

        return Blade::render('<x-dynamic-component :component="$view" :label="$label" :options="$options" :fields="$fields" name="{{$name}}" />', [
            'view' => $this->view,
            'label' => $this->label,
            'name' => $this->name,
            'value' => $this->value,
            'options' => $this->options,
            'fields' => $fields,
        ]);
    }
}
