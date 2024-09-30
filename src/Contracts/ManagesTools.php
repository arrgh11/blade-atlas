<?php

namespace Arrgh11\Atlas\Contracts;

trait ManagesTools
{
    protected $tools = [];

    public function getTools()
    {
        //initialize and return tools

        $tools = [];

        foreach ($this->tools as $tool) {
            $tools[] = [
                'view' => $tool::view(),
                'component' => $tool::component(),
            ];
        }

        return $tools;

    }

    public function registerTool($tool)
    {
        $this->tools[] = $tool;
    }
}
