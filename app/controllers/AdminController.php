<?php

class AdminController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth.admin', ['except'=>['getLogin', 'postLogin'] ] );
        $this->layout = 'admin._layout';
    }

    public function getIndex() {


        $this->layout->content = View::make('admin.index', array('trans' => Repo::make('language')->getFormattedList()));
    }

    public function postTrans() {

        foreach (Input::get('item') as $key => $item) {
            foreach ($item as $lng => $value) {
                Translation::where('key', $key)->where('lng', $lng)->update(['value' => $value['value']]);
            }

        }


        return Redirect::action('AdminController@getIndex');
    }

    public function postTransNew() {

//        echo '<pre>';
//        var_dump(Input::all());exit;

        $keyTrans = Input::get('key');
        $itemTrans = Input::get('item');

        foreach ($itemTrans as $key => $item) {

                Translation::insert([
                    'key' => $keyTrans,
                    'lng' => $key,
                    'value' => $item['value']
                ]);

        }


        return Redirect::action('AdminController@getIndex');
    }

    public function postLogin() {

        $email = Input::get('email');
        $password = Input::get('password');

        if ( Auth::attempt( ['email'=>$email, 'password'=>$password, 'is_admin'=>'1'] ))
        {
            return Redirect::action('AdminController@getIndex');

        } else {
            return Redirect::action('AdminController@getLogin');
        }
    }

    public function getLogin() {

        $this->layout->content = View::make('admin.login');

    }

}
