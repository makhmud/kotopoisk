<?php

namespace CatSearch\ServiceProviders;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package CatSearch\ServiceProviders
 */
class RepositoryServiceProvider extends ServiceProvider {

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->app->bind('repository', function()
        {
            return new \CatSearch\Repository\Repository();
        });
    }

}