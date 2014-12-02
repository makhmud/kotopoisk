<?php

class AdminCatsController extends AdminBaseController {

    public function getIndex() {

        $this->layout->content = View::make('admin.cats', array('cats' => Cat::with('author')->orderBy('created_at', 'desc')->get() ));

    }

    public function getDelete($id) {
        Cat::find($id)->delete();

        return Redirect::action('AdminCatsController@getIndex');
    }

}
