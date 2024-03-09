<?php

namespace ITUTUMedia\LaravelModulesLivewireTable\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ITUTUMedia\LaravelModulesLivewireTable\Support\Decomposer;

trait ComponentParser
{
    use CommandHelper;

    protected $component;

    protected $module;

    protected $model;

    protected $directories;

    protected function parser()
    {
        $checkDependencies = Decomposer::checkDependencies(
            $this->isCustomModule() ? ['livewire/livewire'] : null
        );

        if ($checkDependencies->type == 'error') {
            $this->line($checkDependencies->message);

            return false;
        }

        if (! $module = $this->getModule()) {
            return false;
        }

        $this->module = $module;

        $this->directories = collect(
            preg_split('/[.\/(\\\\)]+/', $this->argument('component'))
        )->map([Str::class, 'studly']);

        $this->component = $this->getComponent();

        $this->model = $this->getModel();

        return $this;
    }

    protected function getComponent()
    {
        $classInfo = $this->getClassInfo();

        $stubInfo = $this->getStubInfo();

        return (object) [
            'class' => $classInfo,
            'stub' => $stubInfo,
        ];
    }

    protected function getClassInfo()
    {
        $modulePath = $this->getModulePath();

        $moduleLivewireNamespace = $this->getModuleLivewireNamespace();

        $classDir = (string) Str::of($modulePath)
            ->append('/'.$moduleLivewireNamespace)
            ->replace(['\\'], '/');

        $classPath = $this->directories->implode('/');

        $namespace = $this->getNamespace($classPath);

        $className = $this->directories->last();

        $componentTag = $this->getComponentTag();

        return (object) [
            'dir' => $classDir,
            'path' => $classPath,
            'file' => $classDir.'/'.$classPath.'.php',
            'namespace' => $namespace,
            'name' => $className,
            'tag' => $componentTag,
        ];
    }

    protected function getStubInfo()
    {
        $defaultStubDir = __DIR__.'/../../stubs/';

        $stubDir = File::isDirectory($publishedStubDir = base_path('stubs/modules-livewire-table/'))
            ? $publishedStubDir
            : $defaultStubDir;

        $classStubName = 'table.stub';

        $classStub = File::exists($stubDir.$classStubName)
            ? $stubDir.$classStubName
            : $defaultStubDir.$classStubName;

        return (object) [
            'dir' => $stubDir,
            'class' => $classStub,
        ];
    }

    protected function getClassContents()
    {
        $template = file_get_contents($this->component->stub->class);

        return preg_replace(
            ['/\[namespace\]/', '/\[class\]/', '/\[model\]/', '/\[model_import\]/', '/\[columns\]/'],
            [$this->getClassNamespace(), $this->getClassName(), $this->getModelName(), $this->getModelImport(), $this->generateColumns($this->getModelImport())],
            $template,
        );
    }

    private function generateColumns(string $modelName): string
    {
        $model = new $modelName();

        if ($model instanceof Model === false) {
            throw new \Exception('Invalid model given.');
        }

        $getFillable = [
            ...[$model->getKeyName()],
            ...$model->getFillable(),
            ...['created_at', 'updated_at'],
        ];

        $columns = "[\n";

        foreach ($getFillable as $field) {
            if (in_array($field, $model->getHidden())) {
                continue;
            }

            $title = Str::of($field)->replace('_', ' ')->ucfirst();

            $columns .= '            Column::make("'.$title.'", "'.$field.'")'."\n".'                ->sortable(),'."\n";
        }

        $columns .= '        ]';

        return $columns;
    }

    public function getModelImport(): string
    {
        if (File::exists(app_path('Models/'.$this->model.'.php'))) {
            return 'App\Models\\'.$this->model;
        }

        if (File::exists(app_path($this->model.'.php'))) {
            return 'App\\'.$this->model;
        }
        
        return str_replace('/', '\\', $this->model);
    }

    public function getModelName(): string
    {
        $explode = explode('\\', $this->getModelImport());
        return end($explode);
    }

    protected function getClassSourcePath()
    {
        return Str::after($this->component->class->file, $this->getBasePath().'/');
    }

    protected function getClassNamespace()
    {
        return $this->component->class->namespace;
    }

    protected function getClassName()
    {
        return $this->component->class->name;
    }

    protected function getComponentTag()
    {
        $directoryAsView = $this->directories
            ->map([Str::class, 'kebab'])
            ->implode('.');

        $tag = "<livewire:{$this->getModuleLowerName()}::{$directoryAsView} />";

        $tagWithOutIndex = Str::replaceLast('.index', '', $tag);

        return $tagWithOutIndex;
    }

    protected function getComponentQuote()
    {
        return "The <code>{$this->getClassName()}</code> livewire component is loaded<code>{$this->getModuleName()}</code> module.";
    }

    protected function getBasePath($path = null)
    {
        return strtr(base_path($path), ['\\' => '/']);
    }
}
