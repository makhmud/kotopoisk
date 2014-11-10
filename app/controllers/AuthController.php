<?php

class AuthController extends \BaseController {

    /**
     * Login user with auth token
     * @return Response
     */
	public function postLogin () {

        if ( Auth::attempt( Input::only( array('email', 'password') )))
        {
            $user = Auth::user();
            $user->auth_token = Hash::make( time() );
            $user->save();

            Session::set('auth_token', $user->auth_token);
            Session::set('auth_id', Auth::id());

            Log::info(array(
                'login' => $user->auth_token,
                Session::get('auth_token')
            ));

            return Response::json( array(
                'success' => true,
                'auth_id' => Auth::id(),
                'auth_token' => $user->auth_token
            ));

        } else {

            return Response::json( array(
                'success' => false
            ));

        }
    }

    public function getCheck() {

        if (Input::has('auth_token')) {

            $user = User::where('auth_token', '=', Input::get('auth_token'))->first();
            if ( is_null($user) ) {
                return Response::answer(null, false, 'Not logged in');
            } else {
                return Response::answer($user);
            }

        } else {
            return Response::answer(null, false, 'Needs auth_token');
        }
    }

    public function getLogout () {

        $user = Auth::user();
        $user->auth_token = null;
        $user->save();

        Auth::logout();

        Session::forget('auth_token');

        return Response::json( array(
            'success' => true,
        ));
    }

    public function putRegister () {

    }

}
