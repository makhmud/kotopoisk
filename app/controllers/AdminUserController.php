<?php

class AdminUserController extends AdminBaseController {

    public function getIndex() {

        $this->layout->content = View::make('admin.users', array('users' => User::with('contacts')->orderBy('created_at', 'desc')->get() ));

    }

    public function getDelete($id) {
        User::find($id)->delete();

        return Redirect::back();
    }

    public function getLock($id) {
        $user = User::find($id);
        $user->locked = 1;
        $user->save();

        return Redirect::back();
    }

    public function getUnlock($id) {
        $user = User::find($id);
        $user->locked = 0;
        $user->save();

        return Redirect::back();
    }

}
