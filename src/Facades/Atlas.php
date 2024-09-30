<?php

namespace Arrgh11\Atlas\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Arrgh11\Atlas\Atlas
 */
class Atlas extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Arrgh11\Atlas\Atlas::class;
    }
}
