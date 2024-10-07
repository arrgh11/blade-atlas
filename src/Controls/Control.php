<?php

namespace Arrgh11\Atlas\Controls;

abstract class Control
{
    public string $name = '';

    public string $label = '';

    public ?string $view = null;

    public mixed $value = null;

    public function __construct(
        ?string $name = null,
    ) {
        $this->name = $name;
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

    abstract public function getView(): string;
}
