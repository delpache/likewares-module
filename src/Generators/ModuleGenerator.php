<?php

namespace Likewares\ModuleGenerator\Generators;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem;
use Likewares\ModuleGenerator\Module;

class ModuleGenerator
{
    /**
     * Namespace module vendor.
     *
     * @var string
     */
    protected $vendorNamespace;

    /**
     * Nom du module.
     *
     * @var string
     */
    protected $moduleName;

    /**
     * Argument.
     *
     * @var bool
     */
    protected $plain;

    /**
     * L'argument qui force les réécritures.
     *
     * @var bool
     */
    protected $force;

    /**
     * Définir le type de module.
     *
     * @var string
     */
    protected $type = 'module';

    /**
     * Contient une instance de console
     *
     * @var \Illuminate\Console\Command
     */
    protected $console;

    /**
     * Contient une instance du générateur
     *
     * @var \Likewares\ModuleGenerator\Console\Command
     */
    protected $generator;

    /**
     * Contient des informations sur les sous-fichiers
     *
     * @var array
     */
    protected $stubFiles = [
        'module'  => [
            'views/components/layouts/style'             => 'Resources/views/components/layouts/style.blade.php',
            'views/index'                                => 'Resources/views/index.blade.php',
            'scaffold/menu'                              => 'Config/menu.php',
            'scaffold/acl'                               => 'Config/acl.php',
            'assets/js/app'                              => 'Resources/assets/js/app.js',
            'assets/css/app'                             => 'Resources/assets/css/app.css',
            'assets/images/Icon-Temp'                    => 'Resources/assets/images/Icon-Temp.svg',
            'assets/images/Icon-Temp-Active'             => 'Resources/assets/images/Icon-Temp-Active.svg',
            'package'                                    => '../package.json',
            'vite'                                       => '../vite.config.js',
            'tailwind'                                   => '../tailwind.config.js',
            'postcss'                                    => '../postcss.config.js',
            '.gitignore'                                 => '../.gitignore',
            'composer'                                   => '../composer.json',
        ],
    ];

    /**
     * Contient les chemins d'accès aux fichiers du module pour la création
     *
     * @var array
     */
    protected $paths = [
        'module'  => [
            'config'     => 'Config',
            'command'    => 'Console/Commands',
            'migration'  => 'Database/Migrations',
            'seeder'     => 'Database/Seeders',
            'contracts'  => 'Contracts',
            'model'      => 'Models',
            'routes'     => 'Http',
            'controller' => 'Http/Controllers',
            'filter'     => 'Http/Middleware',
            'request'    => 'Http/Requests',
            'provider'   => 'Providers',
            'repository' => 'Repositories',
            'event'      => 'Events',
            'listener'   => 'Listeners',
            'emails'     => 'Mail',
            'assets'     => 'Resources/assets',
            'lang'       => 'Resources/lang',
            'views'      => 'Resources/views',
        ],
    ];

    /**
     * Créer une nouvelle instance du générateur.
     *
     * @return void
     */
    public function __construct(
        protected Config $config,
        protected Filesystem $filesystem,
        protected Module $module
    ) {}

    /**
     * Setter le générateur
     */
    public function setModuleGenerator(mixed $generator): self
    {
        $this->generator = $generator;

        return $this;
    }

    /**
     * Setter la console
     */
    public function setConsole(mixed $console): self
    {
        $this->console = $console;

        return $this;
    }

    /**
     * Setter le module.
     */
    public function setModule(mixed $moduleName): self
    {
        $this->moduleName = $moduleName;

        return $this;
    }

    /**
     * Setter le module simple.
     */
    public function setPlain(mixed $plain): self
    {
        $this->plain = $plain;

        return $this;
    }

    /**
     * Forcer status.
     */
    public function setForce(mixed $force): self
    {
        $this->force = $force;

        return $this;
    }

    /**
     * Setter le type status.
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Générer un module
     */
    public function generate(): void
    {
        if ($this->module->has($this->moduleName)) {
            if ($this->force) {
                $this->module->delete($this->moduleName);
            } else {
                $this->console->error(sprintf('Le Module %s existe déjà !', $this->moduleName));

                return;
            }
        }

        $this->createFolders();

        if (! $this->plain) {
            $this->createFiles();

            $this->createClasses();
        }

        $this->console->info(sprintf('Module %s créé avec succès.', $this->moduleName));
    }

    /**
     * Générer les dossiers du module
     */
    public function createFolders(): void
    {
        foreach ($this->paths[$this->type] as $key => $folder) {
            $path = base_path('modules/'.$this->moduleName.'/src').'/'.$folder;

            $this->filesystem->makeDirectory($path, 0755, true);
        }
    }

    /**
     * Générer les fichiers du module
     */
    public function createFiles(): void
    {
        $variables = $this->getStubVariables();

        foreach ($this->stubFiles[$this->type] as $stub => $file) {
            $path = base_path('modules/'.$this->moduleName.'/src').'/'.$file;

            if (! $this->filesystem->isDirectory($dir = dirname($path))) {
                $this->filesystem->makeDirectory($dir, 0775, true);
            }

            $this->filesystem->put($path, $this->getStubContents($stub, $variables));

            $this->console->info("Fichier créé : {$path}");
        }
    }

    /**
     * Générer les classes du module
     */
    public function createClasses(): void
    {
        if ($this->type == 'module') {
            $this->generator->call('module:make-provider', [
                'name'    => $this->moduleName.'ServiceProvider',
                'module' => $this->moduleName,
            ]);

            $this->generator->call('module:make-module-provider', [
                'name'    => 'ModuleServiceProvider',
                'module' => $this->moduleName,
            ]);

            $this->generator->call('module:make-controller', [
                'name'    => $this->moduleName.'Controller',
                'module' => $this->moduleName,
            ]);

            $this->generator->call('module:make-route', [
                'module' => $this->moduleName,
            ]);
        }
    }

    /**
     * Récupérer les variables du fichier stub.
     */
    protected function getStubVariables(): array
    {
        return [
            'LOWER_NAME'      => $this->getLowerName(),
            'CAPITALIZE_NAME' => $this->getCapitalizeName(),
            'MODULE'         => $this->getClassNamespace($this->moduleName),
            'CLASS'           => $this->getClassName(),
        ];
    }

    /**
     * Récupérer le nom de la classe du module.
     */
    protected function getClassName(): string
    {
        return class_basename($this->moduleName);
    }

    /**
     * Récupérer l'espace de nom de la classe du module.
     */
    protected function getClassNamespace($name): array|string
    {
        return str_replace('/', '\\', $name);
    }

    /**
     * Retourne le contenu du fichier stub
     */
    public function getStubContents(string $stub, array $variables = []): mixed
    {
        $path = __DIR__.'/../stubs/'.$stub.'.stub';

        $contents = file_get_contents($path);

        foreach ($variables as $search => $replace) {
            $contents = str_replace('$'.strtoupper($search).'$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Récupérer le nom en majuscule du module.
     */
    protected function getCapitalizeName(): string
    {
        return ucwords(class_basename($this->moduleName));
    }

    /**
     * Récupérer le nom en miniscule du module.
     */
    protected function getLowerName(): string
    {
        return strtolower(class_basename($this->moduleName));
    }
}
