<?php

namespace ITUTUMedia\LaravelModulesLivewireTable\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ITUTUMedia\LaravelModulesLivewireTable\Traits\ComponentParser;

class LaravelModulesLivewireTableCommand extends Command
{
    use ComponentParser;

    public $signature = 'module:make-datatable {component} {model} {module} {--force} {--custom}';

    public $description = 'Create a new Livewire table component for a module';

    public function handle(): int
    {
        if (! $this->parser()) {
            return false;
        }

        if (! $this->checkClassNameValid()) {
            return false;
        }

        if (! $this->checkReservedClassName()) {
            return false;
        }

        $class = $this->createClass();

        if ($class) {
            $this->line("<options=bold,reverse;fg=green> COMPONENT CREATED </> 🤙\n");

            $class && $this->line("<options=bold;fg=green>CLASS:</> {$this->getClassSourcePath()}");
        }

        return false;
    }

    protected function createClass()
    {
        $classFile = $this->component->class->file;

        if (File::exists($classFile) && ! $this->isForce()) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>Class already exists:</> {$this->getClassSourcePath()}");

            return false;
        }

        $this->ensureDirectoryExists($classFile);

        File::put($classFile, $this->getClassContents());

        return $this->component->class;
    }
}
