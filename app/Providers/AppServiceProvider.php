<?php

namespace App\Providers;

use App\Contracts\StorageFile;
use App\Contracts\Store as StoreContract;
use App\Services\StorageFile as StorageFileService;
use App\Services\Store;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        StoreContract::class => Store::class,
        StorageFile::class => StorageFileService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
