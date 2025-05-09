<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-provider')]
class ProviderMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-provider {name} {module} {--force}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouveau service provider.';

    /**
     * Get the stub file for the generator.
     */
    protected function getStubContents(): string
    {
        $stub = $this->hasOption('plain') ? 'provider' : 'scaffold/package-provider';

        return $this->moduleGenerator->getStubContents($stub, $this->getStubVariables());
    }

    /**
     * Get the stub variables.
     */
    protected function getStubVariables(): array
    {
        return [
            'NAMESPACE'  => $this->getClassNamespace($this->argument('module').'/Providers'),
            'CLASS'      => $this->getClassName(),
            'LOWER_NAME' => $this->getLowerName(),
        ];
    }

    /**
     * Get the source file path.
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('modules/'.$this->argument('module')).'/src/Providers';

        return "$path/{$this->getClassName()}.php";
    }
}
