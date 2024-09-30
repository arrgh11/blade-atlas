<?php

namespace Arrgh11\Atlas\Tools;

use Arrgh11\Atlas\Concerns\HasAtlasTooling;

abstract class Tool implements HasAtlasTooling
{
    //Blade view
    protected static string $view = '';

    //Alpine component
    protected static string $component = '';

    public static function view(): string
    {
        return static::$view;
    }

    public static function component(): string
    {
        return static::$component;
    }
}
