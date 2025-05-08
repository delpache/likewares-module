<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-controller')]
class ControllerMakeCommand extends MakeCommand
{
    /**
     * Le nom et la signature de la commande de la console.
     *
     * @var string
     */
    protected $signature = 'module:make-controller {name} {module} {--force}';

    /**
     * Le type de classe générée.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Description de la commande de la console.
     *
     * @var string|null
     */
    protected $description = 'Créer un nouveau controller.';

    /**
     * Get the stub file for the generator.
     */
    protected function getStubContents(): string
    {
        return $this->moduleGenerator->getStubContents('controller', $this->getStubVariables());
    }

    /**
     * Get the stub variables.
     */
    protected function getStubVariables(): array
    {
        return [
            'NAMESPACE'  => $this->getClassNamespace($this->argument('module').'/Http/Controllers'),
            'CLASS'      => $this->getClassName(),
            'LOWER_NAME' => $this->getLowerName(),
        ];
    }

    /**
     * Get the source file path.
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('modules/'.$this->argument('module')).'/src/Http/Controllers';

        return "$path/{$this->getClassName()}.php";
    }
}
