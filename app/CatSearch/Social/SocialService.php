<?php

namespace CatSearch\Social;

use \Vinelab\Http\Client;


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
            return new $className( \Config::get( 'social.' . $networkName ), new Client() );
        } else {
            return false;
        }
    }

    /**
     * Total shared count
     * @param $url
     * @param array $only
     * @return int
     */
    public function totalCount($url, $only = ['vk', 'fb', 'twitter', 'gp', 'ok']) {

        $total = 0;

        foreach ($only as $prefix) {
            $total += $this->make($prefix)->getSharedCount($url);
        }

        return $total;

    }

} 