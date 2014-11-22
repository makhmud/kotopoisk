<?php
/**
 * Created by PhpStorm.
 * User: geronimo
 * Date: 22.11.14
 * Time: 1:45
 */

namespace CatSearch\Social;


class SocialService {

    private $_adapter;

    /**
     * Return repository instance
     * @param $networkName
     * @return bool
     */
    public function make( $networkName ) {

        $className = __NAMESPACE__ . '\\Adapter\\' . ucfirst($networkName) . 'Adapter';

        if ( class_exists($className) ) {
            return new $className;
        } else {
            return false;
        }
    }

    public function totalCount($url, $only = ['vk', 'fb', 'twitter', 'gp', 'ok']) {

        $total = 0;

        foreach ($only as $prefix) {
            $total += $this->make($prefix)->getSharedCount($url);
        }

        return $total;

    }

} 