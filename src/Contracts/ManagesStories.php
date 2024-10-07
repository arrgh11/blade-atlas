<?php

namespace Arrgh11\Atlas\Contracts;

use Arrgh11\Atlas\ControlBag;
use Illuminate\Support\Str;
use Livewire\Livewire;

trait ManagesStories
{
    protected $stories = [];

    public function getStories()
    {
        return $this->stories;
    }

    public function getStory($component): array
    {

        //ensure the component starts with 'atlas'
        if (! Str::startsWith($component, 'atlas')) {
            $component = 'atlas-'.$component;
        }

        return collect($this->stories)->map(function ($group) use ($component) {
            return collect($group)->filter(function ($storyObj) use ($component) {
                return $storyObj['component'] === $component;
            })->map(function ($storyObj) {
                return $storyObj;
            });
        })->flatten()->toArray();
    }

    public function renderStory($component, $data = [])
    {
        $story = $this->getStory($component);

        if (empty($story)) {
            return null;
        }

        //if data has controls, convert to ControlBag
        if (isset($data['controls'])) {
            $data['controls'] = new ControlBag($data['controls']);
        }

        return view($story[4], $data)->fragment('story');
    }

    public function discoverStories()
    {
        $paths = config('atlas.discover.paths');

        $storyGroups = [];

        foreach ($paths as $path) {
            //get group folders in the path
            $groups = scandir($path);

            //remove . and .. from the array
            $groups = array_diff($groups, ['.', '..']);

            //loop through the groups
            foreach ($groups as $group) {
                //get the stories in the group
                $stories = scandir($path.'/'.$group);

                //remove . and .. from the array
                $stories = array_diff($stories, ['.', '..']);

                //loop through the stories
                foreach ($stories as $story) {
                    //register the story file as a Livewire component

                    $storyName = Str::replace('.php', '', $story);

                    $kebab = Str::kebab('atlas '.$group.' '.$storyName);

                    $className = 'App\\Atlas\\Stories\\'.$group.'\\'.$storyName;

                    Livewire::component($kebab, $className);

                    $storyGroups[$group][] = [
                        'component' => $kebab,
                        'class' => $className,
                        'title' => $className::getStoryName(),
                        'route' => $className::getStoryId(),
                        'view' => $className::getView(),
                    ];

                }

            }

        }

        $this->stories = $storyGroups;
    }
}
