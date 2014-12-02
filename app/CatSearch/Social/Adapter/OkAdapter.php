<?php

namespace CatSearch\Social\Adapter;


class OkAdapter extends AbstractAdapter implements CountableInterface {

    public function buildSharedCountRequest($url)
    {
        return [
            'url' => $this->config['url'] . 'dk',
            'params' => [
                'st.cmd'    => 'shareData',
                'ref'       => $url,
            ]
        ];
    }

    public function proceedSharedCountResponse($response)
    {
        $response = $response->content();

        return 0;
    }
}