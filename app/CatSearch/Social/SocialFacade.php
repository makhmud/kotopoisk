<?php

namespace CatSearch\Social;

use Illuminate\Support\Facades\Facade;


class SocialFacade extends Facade {

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor() { return 'social'; }

} 