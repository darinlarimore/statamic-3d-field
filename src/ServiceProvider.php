<?php

namespace Darinlarimore\Statamic3dField;

use Statamic\Providers\AddonServiceProvider;
use Darinlarimore\Statamic3dField\Fieldtypes\threeDModel;
use Darinlarimore\Statamic3dField\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;
use Darinlarimore\Statamic3dField\Tags\ThreeDModelTag;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    // register assets
    protected $vite = [
        'input' => [
            'resources/js/main.js',
            'resources/css/main.css',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    // register tags
    protected $tags = [
        ThreeDModelTag::class,
    ];

    public function bootAddon()
    {
        // register field type
        threeDModel::register();

        // register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'three-d-model');
    }
}
