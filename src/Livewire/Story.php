<?php

namespace Arrgh11\Atlas\Livewire;

use Livewire\Component;

abstract class Story extends Component implements Contracts\IsStory
{
    use Concerns\InteractsWithCode;
    use Concerns\InteractsWithControls;

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

    public function render()
    {
        return view($this->view, [
            'title' => $this->getStoryName(),
            'controls' => $this->renderControls(),
            'code' => $this->getCode(),
        ])
            ->title($this->getStoryName())
            ->layout(config('atlas.globals.layout'));
    }
}
