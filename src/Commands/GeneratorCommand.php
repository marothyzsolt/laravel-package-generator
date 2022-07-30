<?php

namespace Marothyzsolt\LaravelPackageGenerator\Commands;

use Illuminate\Console\GeneratorCommand as Generator;
use Marothyzsolt\LaravelPackageGenerator\Traits\CreatesPackageStubs;

abstract class GeneratorCommand extends Generator
{
    use CreatesPackageStubs;

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }
}
