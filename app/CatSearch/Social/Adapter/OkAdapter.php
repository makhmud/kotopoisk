<?php

namespace CatSearch\Social\Adapter;


class OkAdapter extends AbstractAdapter implements CountableInterface {

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    public function proceedSharedCountResponse($response)
    {
        $response = $response->content();

        return 0;
    }
}