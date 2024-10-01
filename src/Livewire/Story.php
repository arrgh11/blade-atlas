<?php

namespace Arrgh11\Atlas\Livewire;

use Livewire\Attributes\Layout;

abstract class Story implements Contracts\IsStory
{
    //    use Concerns\InteractsWithCode;
    //    use Concerns\InteractsWithControls;

    public static function getStoryName(): string
    {
        return class_basename(static::class);
    }

    public static function getStoryId(): string
    {
        return (string) str(static::class)
            ->replace('\\', ' ')
            ->replace('Atlas', 'Atlas')
            ->kebab();

    }

    //    #[Layout('layouts.app')]
    public static function render(array $props = [])
    {
        //get the view from the class
        $story = new static;

        return view($story->view, $props);
    }
}
