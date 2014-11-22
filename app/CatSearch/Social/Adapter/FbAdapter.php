<?php
namespace CatSearch\Social\Adapter;


class FbAdapter extends AbstractAdapter implements Countable {

    public function getSharedCount($url) {

        //:http://graph.facebook.com/fql?q=SELECT+total_count+FROM+link_stat+WHERE+url%3D%22http%3A%2F%2Flocalhost%2Ffeed%2F181%22&callback=angular.callbacks._6
        $request = [
            'url' => 'http://graph.facebook.com/fql',
            'params' => [
                'q'    => 'SELECT total_count FROM link_stat WHERE url="' . $url . '"'
            ]
        ];

        $response = \HttpClient::get($request)->json();

        if (isset($response->data) && count($response->data)>0 ){
            return (int) $response->data[0]->total_count;
        } else {
            return 0;
        }

    }

} 