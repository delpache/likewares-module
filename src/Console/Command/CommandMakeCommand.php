<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-command')]
class CommandMakeCommand extends MakeCommand
{
    /**
     * Le nom et la signature de la commande de la console.
     *
     * @var string
     */
    protected $signature = 'module:make-command {name} {module} {--force}';

    /**
     * Le type de classe générée.
     *
     * @var string
     */
    protected $type = 'Console command';

    /**
     * Description de la commande de la console.
     *
     * @var string|null
     */
    protected $description = 'Create a new command.';

    /**
     * Récupérer le fichier stub du générateur.
     */
    protected function getStubContents(): string
    {
        return $this->moduleGenerator->getStubContents('command', $this->getStubVariables());
    }

    /**
     * Récupérer les variables du stub.
     */
    protected function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->getClassNamespace($this->argument('module').'/Console/Commands'),
            'CLASS'     => $this->getClassName(),
        ];
    }

    /**
     * Récupérer le chemin d'accès au fichier source.
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('modules/'.$this->argument('module')).'/src/Console/Commands';

        return "$path/{$this->getClassName()}.php";
    }
}
