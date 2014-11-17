<?php

class AdminUserController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth.admin' );
        $this->layout = 'admin._layout';
    }

    public function getIndex() {


        $this->layout->content = View::make('admin.users', array('users' => User::with('contacts')->get() ));

    }

    public function getDelete($id) {
        User::find($id)->delete();

        return Redirect::action('AdminUserController@getIndex');
    }

    public function getLock($id) {
        $user = User::find($id);
        $user->locked = 1;
        $user->save();

        return Redirect::action('AdminUserController@getIndex');
    }

    public function getUnlock($id) {
        $user = User::find($id);
        $user->locked = 0;
        $user->save();

        return Redirect::action('AdminUserController@getIndex');
    }

}
