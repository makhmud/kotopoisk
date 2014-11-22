<?php
namespace CatSearch\Social\Adapter;


class VkAdapter extends AbstractAdapter implements Countable {

    public function getSharedCount($url) {

        //:http://vkontakte.ru/share.php?act=count&url=http%3A%2F%2Flocalhost%2Ffeed%2F181&index=1
        $request = [
            'url' => 'http://vkontakte.ru/share.php',
            'params' => [
                'act'    => 'count',
                'url'    => $url
//                'format' => 'rss_200'
            ]
        ];

        $response = \HttpClient::get($request)->content();
        $split1 = explode(',', $response);
        $split2 = explode(')', $split1[1]);

        $num = (int) $split2[0];

        return $num;

    }

} 