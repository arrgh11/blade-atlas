<?php

namespace Arrgh11\Atlas\Commands;

use Illuminate\Console\Command;

class AtlasCommand extends Command
{
    public $signature = 'blade-atlas';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
