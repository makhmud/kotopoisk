<?php
namespace CatSearch\Social\Adapter;


interface CountableInterface {

    public function getSharedCount($url);

    /**
     * Method for building request array
     * @param $url
     * @return array
     */
    public function buildSharedCountRequest($url);

    /**
     * Method for specific count procedure
     * @param $url
     * @return int
     */
    public function proceedSharedCountResponse($url);

} 