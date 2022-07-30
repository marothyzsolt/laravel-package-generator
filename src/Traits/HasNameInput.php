<?php

namespace Marothyzsolt\LaravelPackageGenerator\Traits;

use Symfony\Component\Console\Input\InputArgument;

trait HasNameInput
{
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
}
