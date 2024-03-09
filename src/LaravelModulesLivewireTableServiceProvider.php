<?php

namespace ITUTUMedia\LaravelModulesLivewireTable;

use ITUTUMedia\LaravelModulesLivewireTable\Commands\LaravelModulesLivewireTableCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelModulesLivewireTableServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->publishes([
            __DIR__.'/../stubs/' => base_path('stubs/modules-livewire-table'),
        ], ['modules-livewire-table-stub']);
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-modules-livewire-table')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-modules-livewire-table_table')
            ->hasCommand(LaravelModulesLivewireTableCommand::class);
    }
}
