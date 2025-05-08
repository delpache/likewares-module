<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-repository')]
class RepositoryMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-repository {name} {module} {--force}';

    /**
     * The type of class being generated.
     */
    protected $type = 'Repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouveau repository.';

    /**
     * Get the stub file for the generator.
     */
    protected function getStubContents(): string
    {
        return $this->moduleGenerator->getStubContents('repository', $this->getStubVariables());
    }

    /**
     * Get the stub variables.
     */
    protected function getStubVariables(): array
    {
        return [
            'NAMESPACE'      => $this->getClassNamespace($this->argument('module').'/Repositories'),
            'CLASS'          => $this->getClassName(),
            'CONTRACT_CLASS' => $this->getClassNamespace($this->argument('module').'/Contracts/'.$this->getContractName()),
        ];
    }

    /**
     * Get the source file path.
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('modules/'.$this->argument('module')).'/src/Repositories';

        return "$path/{$this->getClassName()}.php";
    }

    /**
     * Get the contract name.
     */
    protected function getContractName(): string
    {
        return str_replace('Repository', '', $this->argument('name'));
    }
}
