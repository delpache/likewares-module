<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-notification')]
class NotificationMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-notification {name} {module} {--force}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer une nouvelle notification.';

    /**
     * Get the stub file for the generator.
     */
    protected function getStubContents(): string
    {
        return $this->moduleGenerator->getStubContents('notification', $this->getStubVariables());
    }

    /**
     * Get the stub variables.
     */
    protected function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->getClassNamespace($this->argument('module').'/Notifications'),
            'CLASS'     => $this->getClassName(),
        ];
    }

    /**
     * Get the source file path.
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('modules/'.$this->argument('module')).'/src/Notifications';

        return "$path/{$this->getClassName()}.php";
    }
}
