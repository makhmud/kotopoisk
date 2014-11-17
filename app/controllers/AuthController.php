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

            Log::info(array(
                'login' => $user->auth_token
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

    public function postSocialLogin() {
        $s = file_get_contents('http://ulogin.ru/token.php?token=' . Input::get('token') . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($s, true);

        Log::info($user);

        if (isset($user['uid'])){
            $uid = $user['uid'];
            $link = $user['identity'];
            $name = $user['first_name'];
            $surname = $user['last_name'];
            $user = Repo::make('user')->getUserBySocialId($uid);

            if (!is_null($user)) {
                $user = User::find($user->id);
                $user->auth_token = Hash::make( time() );
                $user->save();

                return Response::json( array(
                    'success' => true,
                    'auth_id' => $user->id,
                    'auth_token' => $user->auth_token
                ));
            } else {
                $user = new User();
                $user->auth_token = Hash::make( time() );

                $contacts = new Contact( ['name' => $name, 'surname' => $surname, 'web'=> $link]);
                $contacts->save();

                $user->contacts()->associate($contacts);

                $user->save();
                $user->social()->save( new Social( ['uid' => $uid]) );

                return Response::json( array(
                    'success' => true,
                    'auth_id' => $user->id,
                    'auth_token' => $user->auth_token
                ));
            }
        } else {
            return Response::answer([], false, $user['error']);
        }

        //Log::info($user);
        //$user['network'] - соц. сеть, через которую авторизовался пользователь
        //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
        //$user['first_name'] - имя пользователя
        //$user['last_name'] - фамилия пользователя
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

    public function postLogout () {

        $user = User::where('auth_token', '=', Input::get('auth_token'))->first();

        $user->auth_token = null;
        $user->save();

        return Response::json( array(
            'success' => true,
        ));
    }

    public function postRemind () {

        $email = Input::get('email');
        $password = Str::random(8);

        $user = User::where('email', '=', $email)->first();

        Log::info(array(
            'email' => $email,
            'password' => $password
        ));

        Mail::send('mails.'.Input::get('lng').'.remind', array(
            'email' => $email,
            'password' => $password
        ), function($message) use ($email)
        {
            $message->to($email)->subject('Your login and password');
        });

        if ( !is_null($user) ){
            $user->password = Hash::make($password);
            $user->save();
            return Response::answer([]);
        } else {
            return Response::answer([], false, 'Not found');
        }
    }

    public function postChangePass() {

        $oldPass = Input::get('oldPass');
        $newPass = Input::get('newPass');
        $newPassRepeat = Input::get('newPassRepeat');

        if ($newPass != $newPassRepeat) {
            return Response::answer([], false, 'Not equal new password');
        } else {
            $user = User::where('auth_token', '=', Input::get('auth_token') )->first();
            if (!is_null($user)){
                if ( Auth::attempt(array( 'email' => $user->email, 'password' => $oldPass )) ){

                    $user->password = Hash::make($newPass);
                    $user->save();

                    return Response::answer([]);
                } else {
                    return Response::answer([], false, 'Wrong password');
                }
            } else {
                return Response::answer([], false, 'Wrong token');
            }
        }



        return Response::answer($user);
    }

    public function postRegister () {

        $email = Input::get('email');
        $password = Str::random(8);


        User::insert(array(
            'email' => $email,
            'password' => Hash::make($password)
        ));

        Log::info(array(
            'email' => $email,
            'password' => $password
        ));

        Mail::send('mails.'.Input::get('lng').'.register', array(
            'email' => $email,
            'password' => $password
        ), function($message) use ($email)
        {
            $message->to($email)->subject('Данные для входа на сайт');
        });

        return Response::answer([]);
    }

}
