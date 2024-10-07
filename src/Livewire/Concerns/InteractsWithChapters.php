<?php

namespace Arrgh11\Atlas\Livewire\Concerns;

use Arrgh11\Atlas\Livewire\Attributes\Control;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Torchlight\Blade\BladeManager;

trait InteractsWithChapters
{
    //should be 'prefix' => Story::class
    protected array $chapters = [];

    public function getChapters(): array
    {
        $chapters = [];

        //map over the chapters
        foreach ($this->chapters as $prefix => $chapter) {
            //create a new Fieldset control, and add the chapter controls to it

            $label = $chapter::getStoryName();

            $fieldset = new Control(
                type: 'fieldset',
                label: $label,
                fields: $chapter::getControls($prefix . '.')
            );
            $chapters[] = $fieldset;
        }

        return $chapters;
    }

    public function getChapterControls(): array
    {
        $controls = [];

        foreach ($this->chapters as $chapter) {
            $controls[] = $chapter->getControls();
        }

        return $controls;
    }

}
