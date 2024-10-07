<?php

namespace Arrgh11\Atlas;

use Arrgh11\Atlas\Commands\Stories;
use Arrgh11\Atlas\Commands\Tools;
use Arrgh11\Atlas\Controllers\StoryController;
use Arrgh11\Atlas\Livewire\Application;
use Arrgh11\Atlas\Livewire\Synths\ControlBagSynth;
use Arrgh11\Atlas\Livewire\Tests;
use Arrgh11\Atlas\Tools\Viewport;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AtlasServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('atlas')
            ->hasConfigFile()
            ->hasViews()
//            ->hasRoute('web')
            ->hasMigration('create_atlas_table')
            ->hasCommands([
                Stories\NewStoryCommand::class,
                Tools\NewToolCommand::class,
            ]);
    }

    public function packageBooted()
    {
        Livewire::component('atlas-app', Application::class);
        Livewire::component('atlas-test-story', Tests\Button::class);

        Route::macro('atlas', function () {
            Route::prefix('atlas')->name('atlas.')->group(function () {
                Route::get('/dashboard', function () {
                    return view('atlas::application.index');
                })->name('dashboard');

                Route::get('/stories/{story}', [StoryController::class, 'index'])->name('story');

            });
        });

        \Arrgh11\Atlas\Facades\Atlas::registerTool(Viewport::class);

        //        \Arrgh11\Atlas\Facades\Atlas::discoverTools();

        \Arrgh11\Atlas\Facades\Atlas::discoverStories();

        Livewire::propertySynthesizer(ControlBagSynth::class);

    }
}
