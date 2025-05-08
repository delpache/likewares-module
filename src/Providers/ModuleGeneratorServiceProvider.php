<?php

namespace Likewares\ModuleGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Likewares\ModuleGenerator\Console\Command\CommandMakeCommand;
use Likewares\ModuleGenerator\Console\Command\ControllerMakeCommand;
use Likewares\ModuleGenerator\Console\Command\DatagridMakeCommand;
use Likewares\ModuleGenerator\Console\Command\EventMakeCommand;
use Likewares\ModuleGenerator\Console\Command\ListenerMakeCommand;
use Likewares\ModuleGenerator\Console\Command\MailMakeCommand;
use Likewares\ModuleGenerator\Console\Command\MiddlewareMakeCommand;
use Likewares\ModuleGenerator\Console\Command\MigrationMakeCommand;
use Likewares\ModuleGenerator\Console\Command\ModelContractMakeCommand;
use Likewares\ModuleGenerator\Console\Command\ModelMakeCommand;
use Likewares\ModuleGenerator\Console\Command\ModelProxyMakeCommand;
use Likewares\ModuleGenerator\Console\Command\ModuleProviderMakeCommand;
use Likewares\ModuleGenerator\Console\Command\NotificationMakeCommand;
use Likewares\ModuleGenerator\Console\Command\ModuleMakeCommand;
use Likewares\ModuleGenerator\Console\Command\ProviderMakeCommand;
use Likewares\ModuleGenerator\Console\Command\RepositoryMakeCommand;
use Likewares\ModuleGenerator\Console\Command\RequestMakeCommand;
use Likewares\ModuleGenerator\Console\Command\RouteMakeCommand;
use Likewares\ModuleGenerator\Console\Command\SeederMakeCommand;

class ModuleGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void {}

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerCommands();
    }

    /**
     * Register the console commands of this package
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ModuleMakeCommand::class,
                ProviderMakeCommand::class,
                ModuleProviderMakeCommand::class,
                ControllerMakeCommand::class,
                RouteMakeCommand::class,
                MigrationMakeCommand::class,
                ModelMakeCommand::class,
                ModelProxyMakeCommand::class,
                ModelContractMakeCommand::class,
                RepositoryMakeCommand::class,
                SeederMakeCommand::class,
                MailMakeCommand::class,
                CommandMakeCommand::class,
                EventMakeCommand::class,
                ListenerMakeCommand::class,
                MiddlewareMakeCommand::class,
                RequestMakeCommand::class,
                NotificationMakeCommand::class,
                DatagridMakeCommand::class,
            ]);
        }
    }
}
