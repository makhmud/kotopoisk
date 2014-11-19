<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::answer(User::all()->count());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::with(['contacts', 'social'])->find($id);

        return Response::answer($user);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $user = User::with('contacts')->find($id);

        DB::beginTransaction();
        try{
            $user->image = Input::get('image');
            $user->email = Input::get('email');

            if ( empty($user->contacts) ){
                $contacts = new Contact(Input::get('contacts'));
            } else {
                $user->contacts->name = Input::get('contacts.name');
                $user->contacts->surname = Input::get('contacts.surname');
                $user->contacts->phone = Input::get('contacts.phone');
                $user->contacts->web = Input::get('contacts.web');
                $user->contacts->city = Input::get('contacts.city');
                $user->contacts->cats_amount = Input::get('contacts.cats_amount');
                $contacts = $user->contacts;
            }
            $contacts->save();

            $user->contacts()->associate($contacts);
            $user->save();

            DB::commit();

            return Response::answer([]);

        } catch(\Exception $e){

            DB::rollback();

            return Response::answer([], false);
        }



	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
