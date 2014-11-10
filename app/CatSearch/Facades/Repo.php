<?php

namespace CatSearch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Repo - repository facade
 * @package CatSearch\Facades
 */
class Repo extends Facade {

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor() { return 'repository'; }

}