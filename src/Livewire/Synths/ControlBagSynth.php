<?php

namespace Arrgh11\Atlas\Livewire\Synths;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class ControlBagSynth extends Synth
{
    public static $key = 'controls';

    public static function match($target)
    {
        return $target instanceof \Arrgh11\Atlas\ControlBag;
    }

    public function dehydrate($target)
    {
        return [[
            'controls' => $target->all(),
        ], []];
    }

    public function hydrate($value)
    {
        $instance = new \Arrgh11\Atlas\ControlBag($value['controls'] ?? []);

        return $instance;
    }

    //    public function get(&$target, $key)
    //    {
    //        return $target->{$key};
    //    }
    //
    //    public function set(&$target, $key, $value)
    //    {
    //        $target->{$key} = $value;
    //    }
}
