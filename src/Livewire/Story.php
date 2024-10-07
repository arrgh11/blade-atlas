<?php

namespace Arrgh11\Atlas\Livewire;

use Arrgh11\Atlas\Livewire\Attributes\Control;
use Arrgh11\Atlas\Livewire\Concerns\InteractsWithChapters;
use Livewire\Attributes\Layout;

abstract class Story implements Contracts\IsStory
{
    //    use Concerns\InteractsWithCode;
    //    use Concerns\InteractsWithControls;
    use InteractsWithChapters;

    protected static ?string $name = null;

    public static function getStoryName(): string
    {
        return static::$name ?? class_basename(static::class);
    }

    public static function getStoryId(): string
    {
        return (string) str(static::class)
            ->replace('\\', ' ')
            ->replace('Atlas', 'Atlas')
            ->kebab();

    }

    public static function getControls(string $prefix = ''): array
    {
        $controls = [];

        //get the controls attributes from the class, using Reflection
        $reflection = new \ReflectionClass(static::class);
        $activeStory = new static;

        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Control::class);
            if (count($attributes) > 0) {
                $control = $attributes[0]->newInstance();
                $control->setName($prefix.$property->getName());
                $control->setValue($activeStory->{$property->getName()});
                $controls[] = $control;
            }
        }

        return $controls;

    }

    public static function getView(): string
    {
        $story = new static;

        return $story->view;
    }

    //    #[Layout('layouts.app')]
    public static function render(array $props = [])
    {

        return view(static::getView(), $props);
    }
}
