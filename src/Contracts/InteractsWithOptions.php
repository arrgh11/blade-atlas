<?php

namespace Arrgh11\Atlas\Contracts;

use Arrgh11\Atlas\Controls\Control;
use Closure;

trait InteractsWithOptions
{
    public array $options = [];

    public function options(array|Closure $options = []): Control
    {

        //if $options is a closure, call it and set the result to $options
        if ($options instanceof Closure) {
            $this->options = $options();
        } else {
            $this->options = $options;
        }

        return $this;
    }
}
