<?php

namespace ITUTUMedia\LaravelModulesLivewireTable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ITUTUMedia\LaravelModulesLivewireTable\LaravelModulesLivewireTable
 */
class LaravelModulesLivewireTable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ITUTUMedia\LaravelModulesLivewireTable\LaravelModulesLivewireTable::class;
    }
}
