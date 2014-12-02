<?php

namespace CatSearch\Social\Adapter;


class TwitterAdapter extends AbstractAdapter implements CountableInterface {

    public function buildSharedCountRequest($url)
    {
        return [
            'url' => $this->config['url'] . '1/urls/count.json',
            'params' => [
                'url'    => $url
            ]
        ];
    }

    public function proceedSharedCountResponse($response)
    {
        $response = $response->json();

        if ( isset($response->count) ){
            return (int) $response->count;
        } else {
            return 0;
        }
    }
}