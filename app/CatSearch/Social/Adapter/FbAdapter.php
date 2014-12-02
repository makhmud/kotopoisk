<?php

namespace CatSearch\Social\Adapter;


class FbAdapter extends AbstractAdapter implements CountableInterface {

    public function buildSharedCountRequest($url)
    {
        return [
            'url' => $this->config['url'] . 'fql',
            'params' => [
                'q'    => 'SELECT total_count FROM link_stat WHERE url="' . $url . '"'
            ]
        ];
    }

    public function proceedSharedCountResponse($response)
    {
        $response = $response->json();

        if (isset($response->data) && count($response->data)>0 ){
            return (int) $response->data[0]->total_count;
        } else {
            return 0;
        }
    }
}