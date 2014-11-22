<?php
namespace CatSearch\Social;

use Illuminate\Support\ServiceProvider;

class SocialServiceProvider extends ServiceProvider {

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->app->bind('social', function()
        {
            return new \CatSearch\Social\SocialService();
        });
    }

} 