<?php

namespace Marothyzsolt\LaravelPackageGenerator\Commands\Foundation;

use Illuminate\Foundation\Console\ChannelMakeCommand as MakeChannel;
use Marothyzsolt\LaravelPackageGenerator\Traits\CreatesPackageStubs;
use Marothyzsolt\LaravelPackageGenerator\Traits\HasNameInput;

class ChannelMakeCommand extends MakeChannel
{
    use CreatesPackageStubs, HasNameInput;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package:channel';

    /**
     * Get the destination class path.
     *
     * @return string
     */
    protected function resolveDirectory()
    {
        return $this->getDirInput().'src';
    }
}
