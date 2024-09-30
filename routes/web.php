<?php

use Illuminate\Support\Facades\Route;

Route::prefix('atlas')->name('atlas.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('atlas.dashboard');
    })->name('root');

    Route::get('/dashboard', function () {
        return view('atlas::application.index');
    })->name('dashboard');

    Route::get('/stories/{story}', \Arrgh11\Atlas\Livewire\Tests\Button::class)->name('story');

});
