<?php

class AdminGeneralController extends AdminBaseController {

    public function getIndex() {

        $this->layout->content = View::make('admin.users', array(
            'users'     => User::with('contacts')->where('is_admin', 1)->orderBy('created_at', 'desc')->get(),
            'create'    => true
        ));

    }

    public function postIndex() {

        $login = Input::get('login');
        $password = Input::get('password');
        $passordRepeat = Input::get('password_repeat');

        if ($password == $passordRepeat){

            $user = User::create( array(
                'email'     => $login,
                'password'  => Hash::make($password),
                'is_admin'  => 1
            ));
            $user->save();

        }

        return Redirect::back();

    }

} 