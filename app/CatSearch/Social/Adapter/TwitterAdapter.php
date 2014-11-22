<?php
namespace CatSearch\Social\Adapter;


class TwitterAdapter extends AbstractAdapter implements Countable {

    public function getSharedCount($url) {

        //:http://urls.api.twitter.com/1/urls/count.json?url=http%3A%2F%2Flocalhost%2Ffeed%2F181&callback=angular.callbacks._7
        $request = [
            'url' => 'http://urls.api.twitter.com/1/urls/count.json',
            'params' => [
                'url'    => $url
            ]
        ];

        $response = \HttpClient::get($request)->json();

        if ( isset($response->count) ){
            return (int) $response->count;
        } else {
            return 0;
        }
    }

} 