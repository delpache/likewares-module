<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:make-migration')]
class MigrationMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-migration {name} {module}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer une nouvelle migration.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('make:migration', [
            'name'   => $this->argument('name'),
            '--path' => 'modules/'.$this->argument('module').'/src/Database/Migrations',
        ]);
    }
}
