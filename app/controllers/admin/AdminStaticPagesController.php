<?php

class AdminStaticPagesController extends AdminBaseController {

    public function getIndex() {

        $this->layout->content = View::make('admin.static_pages', array('pages' => StaticPageModel::all() ));

    }

    public function postIndex() {

        if (Input::has('id')) {

            StaticPageModel::find( Input::get('id') )
                ->update( Input::all() );

        } else {

            StaticPageModel::create( Input::all() );

        }

        return Redirect::action('AdminStaticPagesController@getIndex');
    }


}
