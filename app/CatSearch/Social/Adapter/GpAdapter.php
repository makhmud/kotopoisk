<?php

namespace CatSearch\Social\Adapter;


class GpAdapter extends AbstractAdapter implements CountableInterface {

    public function buildSharedCountRequest($url)
    {
//        $request = [
//            'url' => 'http://urls.api.twitter.com/1/urls/count.json',
//            'params' => [
//                'url'    => $url
//            ]
//        ];
        return [];
    }

    public function proceedSharedCountResponse($response)
    {
//        if ( isset($response->count) ){
//            return (int) $response->count;
//        } else {
//            return 0;
//        }
        return 0;
    }
}