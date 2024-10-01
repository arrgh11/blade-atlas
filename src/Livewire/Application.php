<?php

namespace Arrgh11\Atlas\Livewire;

use Arrgh11\Atlas\Facades\Atlas;
use Arrgh11\Atlas\Livewire\Concerns\InteractsWithControls;
use Livewire\Attributes\Url;
use Livewire\Component;

class Application extends Component
{

    use InteractsWithControls;

    public array $stories = [];
    public array $tools = [];

    public $activeStory = null;
    public ?string $activeStoryClass = null;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {

        $this->stories = Atlas::getStories();
        $this->tools = Atlas::getTools();
    }

    public function setActiveStory($story)
    {

        //find the story in the stories array by the component key
        $activeStoryClass = collect($this->stories)->map(function ($group) use ($story) {
            return collect($group)->filter(function ($storyObj) use ($story) {
                return $storyObj['component'] === $story;
            })->map(function ($storyObj) {
                return $storyObj;
            });
        });

        if ($activeStoryClass->flatten()->isNotEmpty()) {
            $activeStoryClass = $activeStoryClass->flatten()[1];

            $this->activeStoryClass = $activeStoryClass;
            $this->setControls();
        }


//        $this->activeStory = $story;
    }

    public function render()
    {
        return view('atlas::livewire.application')->with([
            'slot' => $this->activeStoryClass ? $this->activeStoryClass::render([
                'controls' => $this->controlBag,
            ]) : null,
        ]);
    }
}
