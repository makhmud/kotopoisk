<?php

class SeoController extends \BaseController {

    public function __construct()
    {
        $this->layout = 'seo_layout';
    }

    public function feed( $id ){

        $cat = Cat::find( $id );

        return View::make('seo_layout', [
            'seo' => [
                'title' => 'Котопоиск',
                'description' => $cat->content,
                'image' => isset($cat->photos[0]) ? 'http://kotopoisk.com/user/big_' . $cat->photos[0]->path : '',
                'keywords' => ''
            ]
        ]);
    }

} 