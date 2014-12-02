<?php
namespace CatSearch\Social\Adapter;


class VkAdapter extends AbstractAdapter implements CountableInterface {


    public function buildSharedCountRequest($url)
    {
        return [
            'url' => $this->config['url'] . 'share.php',
            'params' => [
                'act'    => 'count',
                'url'    => $url
//                'format' => 'rss_200'
            ]
        ];
    }

    public function proceedSharedCountResponse($response)
    {
        $response = $response->content();
        $split1 = explode(',', $response);
        $split2 = explode(')', $split1[1]);

        $num = (int) $split2[0];

        return $num;
    }
}