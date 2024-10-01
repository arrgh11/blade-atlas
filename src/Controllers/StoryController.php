<?php

namespace Arrgh11\Atlas\Controllers;

use Arrgh11\Atlas\Facades\Atlas;
use Livewire\Features\SupportPageComponents\PageComponentConfig;
use Livewire\Features\SupportPageComponents\SupportPageComponents;

class StoryController
{
    public function index(string $story)
    {

        // Here's we're hooking into the "__invoke" method being called on a component.
        // This way, users can pass Livewire components into Routes as if they were
        // simple invokable controllers. Ex: Route::get('...', SomeLivewireComponent::class);
        $html = null;

        $layoutConfig = SupportPageComponents::interceptTheRenderOfTheComponentAndRetreiveTheLayoutConfiguration(function () use (&$html, $story) {
            //            $params = SupportPageComponents::gatherMountMethodParamsFromRouteParameters($storyClass);

            $stories = Atlas::getStories();

            //get all stories from underneath their group
            $storyClass = collect($stories)->map(function ($group) use ($story) {
                return collect($group)->filter(function ($storyObj) use ($story) {
                    return $storyObj['route'] === $story;
                })->map(function ($storyObj) {
                    return $storyObj['class'];
                });
            })->flatten()->first();

            $html = app('livewire')->mount($storyClass);

        });

        $layoutConfig = $layoutConfig ?: new PageComponentConfig;

        $layoutConfig->normalizeViewNameAndParamsForBladeComponents();

        $response = response(SupportPageComponents::renderContentsIntoLayout($html, $layoutConfig));

        if (is_callable($layoutConfig->response)) {
            call_user_func($layoutConfig->response, $response);
        }

        return $response;
    }

    public function show(string $story)
    {
        return $this->index($story);
    }
}
