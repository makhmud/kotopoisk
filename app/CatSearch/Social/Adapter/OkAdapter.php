<?php
namespace CatSearch\Social\Adapter;


class OkAdapter extends AbstractAdapter implements Countable {

    public function getSharedCount($url) {

        //:http://www.odnoklassniki.ru/dk?st.cmd=shareData&ref=http%3A%2F%2Flocalhost%2Ffeed%2F181&cb=angular.callbacks._9
        $request = [
            'url' => 'http://www.odnoklassniki.ru/dk',
            'params' => [
                'st.cmd'    => 'shareData',
                'ref'       => $url,
            ]
        ];

        $response = \HttpClient::get($request)->content();

        return 0;
    }

} 