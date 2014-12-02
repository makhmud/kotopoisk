<?php

namespace CatSearch\Social\Adapter;

use \Vinelab\Http\Client;


abstract class AbstractAdapter {

    /**
     * Injected array of config
     * @var array
     */
    protected $config;

    /**
     * Injected Http Client for requests
     * @var Client
     */
    protected $httpClient;

    /**
     * Constructor
     * @param array $config
     * @param Client $httpClient
     */
    public function __construct($config = [], Client $httpClient) {

        $this->config = $config;
        $this->httpClient = $httpClient;

    }

    /**
     * Shared count method for countable instances
     * @param $url
     * @return int
     * @throws \Exception
     */
    public function getSharedCount($url) {

        if ($this instanceof CountableInterface){
            $request = $this->buildSharedCountRequest($url);

            try{
                $count = $this->proceedSharedCountResponse( $this->httpClient->get($request) );
            }catch (\Exception $e){
                $count = 0;
            }

            return $count;
        }

        throw new \Exception('Not a countable instance');

    }

} 