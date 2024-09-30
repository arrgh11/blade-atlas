<?php

namespace Arrgh11\Atlas\Livewire\Concerns;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Torchlight\Blade\BladeManager;

trait InteractsWithCode
{
    public function getCode()
    {
        //get the code fragment from the view
        // Get the file path using Laravel's view finder
        $bladeFilePath = View::getFinder()->find($this->view);

        // Get the contents of the Blade file
        $bladeFileContents = file_get_contents($bladeFilePath);

        // Use a regular expression to capture the content between @fragment('code') and @endfragment
        $pattern = '/@fragment\(\'code\'\)(.*?)@endfragment/s';
        preg_match($pattern, $bladeFileContents, $matches);

        $fragmentContent = $matches[1] ?? '';

        $controls = $this->getControls();

        $variables = [];

        foreach ($controls as $control) {
            $variable = $control->name;
            $variables[$variable] = $this->$variable;
        }

        // Search and replace Blade variables
        foreach ($variables as $variable => $replacement) {
            $fragmentContent = preg_replace('/{{\s*\$'.preg_quote($variable, '/').'\s*}}/', $replacement, $fragmentContent);
        }

        return $fragmentContent;

        $rendered = BladeManager::renderContent($fragmentContent);

        return $rendered;

        //        return Blade::render('<x-torchlight-code language="blade" theme="github-dark">'.$rendered.'</x-torchlight-code>')

    }
}
