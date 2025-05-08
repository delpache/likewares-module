<?php

namespace Likewares\ModuleGenerator\Console\Command;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use Likewares\ModuleGenerator\Generators\ModuleGenerator;

class MakeCommand extends Command implements PromptsForMissingInput
{
    /**
     * Le type de classe générée.
     *
     * @var string
     */
    protected $type;

    /**
     * Créer une nouvelle instance de command.
     *
     * @return void
     */
    public function __construct(
        protected Filesystem $filesystem,
        protected ModuleGenerator $moduleGenerator
    ) {
        parent::__construct();

        $this->filesystem = $filesystem;

        $this->moduleGenerator = $moduleGenerator;
    }

    /**
     * Exécuter la commande de la console.
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        if (! $this->filesystem->isDirectory($dir = dirname($path))) {
            $this->filesystem->makeDirectory($dir, 0777, true);
        }

        $contents = $this->getStubContents();

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $contents);
        } else {
            if ($this->option('force')) {
                $this->filesystem->put($path, $contents);
            } else {
                $this->components->error(sprintf('%s [%s] existent déjà.', $this->type, $path));

                return;
            }
        }

        $this->components->info(sprintf('%s [%s] créé avec succès.', $this->type, $path));
    }

    /**
     * Récupérer le nom dans le cas d'étude.
     */
    public function getStudlyName(): string
    {
        return class_basename($this->argument('module'));
    }

    /**
     * Récupérer le nom en minuscules.
     */
    protected function getLowerName(): string
    {
        return strtolower($this->getStudlyName());
    }

    /**
     * Récupérer le nom de la classe.
     */
    protected function getClassName(): string
    {
        return class_basename($this->argument('name'));
    }

    /**
     * Récupérer le namespace de la classe.
     */
    protected function getClassNamespace(string $name): array|string
    {
        return str_replace('/', '\\', $name);
    }

    /**
     * Demander les arguments d'entrée manquants à l'aide des questions renvoyées.
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => [
                'Quel doit être le nom de '.strtolower($this->type),
                match ($this->type) {
                    'Console command' => 'Exemple: SendEmails',
                    'Controller'      => 'Exemple: UserController',
                    'Datagrid'        => 'Exemple: ProductDatagrid',
                    'Event'           => 'Exemple: PodcastProcessed',
                    'Listener'        => 'Exemple: SendPodcastNotification',
                    'Mailable'        => 'Exemple: OrderShipped',
                    'Middleware'      => 'Exemple: EnsureTokenIsValid',
                    'Migration'       => 'Exemple: create_flights_table',
                    'Model'           => 'Exemple: Flight',
                    'Model Proxy'     => 'Exemple: FlightProxy',
                    'Contract'        => 'Exemple: Flight',
                    'Module Provider' => 'Exemple: ModuleServiceProvider',
                    'Provider'        => 'Exemple: ElasticServiceProvider',
                    'Notification'    => 'Exemple: InvoicePaid',
                    'Repository'      => 'Exemple: UserRepository',
                    'Request'         => 'Exemple: StorePodcastRequest',
                    'Route'           => 'Exemple: web',
                    'Seeder'          => 'Exemple: UserSeeder',
                    default           => '',
                },
            ],
        ];
    }
}
