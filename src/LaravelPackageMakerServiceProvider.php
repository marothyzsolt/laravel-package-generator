<?php

namespace Marothyzsolt\LaravelPackageGenerator;

use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\ServiceProvider;
use Marothyzsolt\LaravelPackageGenerator\Commands\AddPackage;
use Marothyzsolt\LaravelPackageGenerator\Commands\ClonePackage;
use Marothyzsolt\LaravelPackageGenerator\Commands\Database\FactoryMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Database\MigrationMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Database\SeederMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\DeletePackageCredentials;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\ChannelMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\ConsoleMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\EventMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\ExceptionMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\JobMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\ListenerMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\MailMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\ModelMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\NotificationMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\ObserverMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\PolicyMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\ProviderMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\RequestMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\ResourceMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\RuleMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Foundation\TestMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\NovaMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\BaseTestMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\CodecovMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\ComposerMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\ContributionMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\GitignoreMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\LicenseMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\PhpunitMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\ReadmeMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\StyleciMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Package\TravisMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\PackageMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Replace;
use Marothyzsolt\LaravelPackageGenerator\Commands\Routing\ControllerMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Routing\MiddlewareMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\SavePackageCredentials;
use Marothyzsolt\LaravelPackageGenerator\Commands\Standard\AnyMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Standard\ContractMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Standard\InterfaceMakeCommand;
use Marothyzsolt\LaravelPackageGenerator\Commands\Standard\TraitMakeCommand;

class LaravelPackageMakerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(MigrationCreator::class)
            ->needs('$customStubPath')
            ->give(function ($app) {
                return $app->basePath('stubs');
            });
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(
            array_merge(
                $this->routingCommands(),
                $this->packageCommands(),
                $this->databaseCommands(),
                $this->standardCommands(),
                $this->foundationCommands(),
                $this->packageInternalCommands()
            )
        );
    }

    /**
     * Get package database related commands.
     *
     * @return array
     */
    protected function databaseCommands()
    {
        return [
            SeederMakeCommand::class,
            FactoryMakeCommand::class,
            MigrationMakeCommand::class,
        ];
    }

    /**
     * Get package foundation related commands.
     *
     * @return array
     */
    protected function foundationCommands()
    {
        return [
            JobMakeCommand::class,
            MailMakeCommand::class,
            TestMakeCommand::class,
            RuleMakeCommand::class,
            EventMakeCommand::class,
            ModelMakeCommand::class,
            PolicyMakeCommand::class,
            ConsoleMakeCommand::class,
            RequestMakeCommand::class,
            ChannelMakeCommand::class,
            ProviderMakeCommand::class,
            ListenerMakeCommand::class,
            ObserverMakeCommand::class,
            ResourceMakeCommand::class,
            ExceptionMakeCommand::class,
            NotificationMakeCommand::class,
        ];
    }

    /**
     * Get package related commands.
     *
     * @return array
     */
    protected function packageCommands()
    {
        return [
            NovaMakeCommand::class,
            ReadmeMakeCommand::class,
            TravisMakeCommand::class,
            LicenseMakeCommand::class,
            PhpunitMakeCommand::class,
            StyleciMakeCommand::class,
            CodecovMakeCommand::class,
            ComposerMakeCommand::class,
            BaseTestMakeCommand::class,
            GitignoreMakeCommand::class,
            ContributionMakeCommand::class,
        ];
    }

    /**
     * Get package internal related commands.
     *
     * @return array
     */
    protected function packageInternalCommands()
    {
        return [
            Replace::class,
            AddPackage::class,
            ClonePackage::class,
            PackageMakeCommand::class,
            SavePackageCredentials::class,
            DeletePackageCredentials::class,
        ];
    }

    /**
     * Get package routing related commands.
     *
     * @return array
     */
    protected function routingCommands()
    {
        return [
            ControllerMakeCommand::class,
            MiddlewareMakeCommand::class,
        ];
    }

    /**
     * Get standard related commands.
     *
     * @return array
     */
    protected function standardCommands()
    {
        return [
            AnyMakeCommand::class,
            TraitMakeCommand::class,
            ContractMakeCommand::class,
            InterfaceMakeCommand::class,
        ];
    }
}
