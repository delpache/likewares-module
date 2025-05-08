<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-model-contract')]
class ModelContractMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-model-contract {name} {module} {--force}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouveau model contract.';

    /**
     * Get the stub file for the generator.
     */
    protected function getStubContents(): string
    {
        return $this->moduleGenerator->getStubContents('model-contract', $this->getStubVariables());
    }

    /**
     * Get the stub variables.
     */
    protected function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->getClassNamespace($this->argument('module').'/Contracts'),
            'CLASS'     => $this->getClassName(),
        ];
    }

    /**
     * Get the source file path.
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('modules/'.$this->argument('module')).'/src/Contracts';

        return "$path/{$this->getClassName()}.php";
    }
}
