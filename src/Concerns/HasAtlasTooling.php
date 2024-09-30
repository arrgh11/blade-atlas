<?php

namespace Arrgh11\Atlas\Concerns;

interface HasAtlasTooling
{
    //require a Blade view
    public static function view(): string;

    //require an Alpine component
    public static function component(): string;
}
