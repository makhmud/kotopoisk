<?php

namespace CatSearch\Social\Adapter;

use \Vinelab\Http\Client;

abstract class AbstractAdapter {

    protected $config;
    protected $httpClient;

    public function __construct($config = [], \Vinelab\Http\Client $httpClient) {

        $this->config = $config;
        $this->httpClient = $httpClient;

    }

//    protected abstract function buildRequest( $url );

//    protected abstract function proceedResponse( $response );

    public function getSharedCount($url) {

        $request = $this->buildSharedCountRequest($url);

        try{
            $count = $this->proceedSharedCountResponse( $this->httpClient->get($request) );
        }catch (\Exception $e){
            $count = 0;
        }

        return $count;

    }

} 