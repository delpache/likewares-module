<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-model')]
class ModelMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-model {name} {module} {--force}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouveau model.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        parent::handle();

        $this->call('module:make-model-proxy', [
            'name'    => $this->argument('name').'Proxy',
            'module' => $this->argument('module'),
            '--force' => $this->option('force'),
        ]);

        $this->call('module:make-model-contract', [
            'name'    => $this->argument('name'),
            'module' => $this->argument('module'),
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStubContents(): string
    {
        return $this->moduleGenerator->getStubContents('model', $this->getStubVariables());
    }

    /**
     * Get the stub variables.
     */
    protected function getStubVariables(): array
    {
        return [
            'MODULE'   => $this->getClassNamespace($this->argument('module')),
            'NAMESPACE' => $this->getClassNamespace($this->argument('module').'/Models'),
            'CLASS'     => $this->getClassName(),
        ];
    }

    /**
     * Get the source file path.
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('modules/'.$this->argument('module')).'/src/Models';

        return "$path/{$this->getClassName()}.php";
    }
}
