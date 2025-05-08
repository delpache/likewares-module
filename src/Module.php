<?php

namespace Likewares\ModuleGenerator;

use Illuminate\Filesystem\Filesystem;

class Module
{
    /**
     * Le constructeur.
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Vérifie si le module existe ou non.
     *
     * @param  strign  $module
     * @return bool
     */
    public function has($module)
    {
        return $this->filesystem->isDirectory(base_path('modules/'.$module));
    }

    /**
     * Supprime un module spécifique.
     *
     * @param  strign  $module
     * @return void
     */
    public function delete($module)
    {
        $this->filesystem->deleteDirectory(base_path('modules/'.$module));
    }
}
