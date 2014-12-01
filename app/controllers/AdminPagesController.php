<?php

class AdminPagesController extends AdminBaseController {

    public function getIndex() {

        $this->layout->content = View::make('admin.pages', array('pages' => Page::all() ));

    }

    public function postIndex() {

        Log::info(Input::all());

        Page::find( Input::get('id') )
            ->update( Input::all() );

        return Redirect::action('AdminPagesController@getIndex');
    }


}
