<?php
/**
 * Created by PhpStorm.
 * User: geronimo
 * Date: 22.11.14
 * Time: 1:48
 */

namespace CatSearch\Social;

use Illuminate\Support\Facades\Facade;


class SocialFacade extends Facade {

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor() { return 'social'; }

} 