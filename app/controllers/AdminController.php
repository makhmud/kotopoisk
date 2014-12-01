<?php

class AdminController extends AdminBaseController {

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth.admin', ['except'=>['getLogin', 'postLogin'] ] );
    }

    public function getIndex() {


        $this->layout->content = View::make('admin.index', array('trans' => Repo::make('language')->getFormattedList()));
    }

    public function getSearch() {

        $search = Input::get('search');
        $this->layout->content = View::make('admin.index', array('trans' => Repo::make('language')->getFormattedList($search)));
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

    public function missingMethod($parameters = array()){
        exit;
    }

}
