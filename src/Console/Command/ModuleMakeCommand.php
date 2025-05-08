<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make')]
class ModuleMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make {module} {--plain}  {--force}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouveau module.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->moduleGenerator
            ->setModuleGenerator($this)
            ->setConsole($this->components)
            ->setModule($this->argument('module'))
            ->setPlain($this->option('plain'))
            ->setForce($this->option('force'))
            ->generate();
    }
}
