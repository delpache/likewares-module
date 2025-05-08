<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-route')]
class RouteMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-route {module} {--force}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouveau fichier router.';

    /**
     * Get the stub file for the generator.
     */
    protected function getStubContents(): string
    {
        return $this->moduleGenerator->getStubContents('routes', $this->getStubVariables());
    }

    /**
     * Get the stub variables.
     */
    protected function getStubVariables(): array
    {
        return [
            'CONTROLLER_CLASS_NAME' => $this->getClassNamespace($this->argument('module').'/Http/Controllers/'.$this->getStudlyName().'Controller'),
            'LOWER_NAME'            => $this->getLowerName(),
            'CLASS_NAME'            => "{$this->getStudlyName()}Controller",
        ];
    }

    /**
     * Get the source file path.
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('modules/'.$this->argument('module')).'/src/Routes';

        return "$path/web.php";
    }
}
