<?php

class CatController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $order = Input::get('order');
        $search = Input::get('search');

        $data = Repo::make('cats')->catsFeed( Input::get('offset') * 15, $order, Input::get('lang'), $search);

        $responseData = array(
            'lock'=>(count($data) < 15),
            'cats'=>$data,
        );

        if (!empty($search)){
            $responseData['searchCount'] = Repo::make('cats')->countSearchResults(  Input::get('search'));
        }

        return Response::answer($responseData);
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
        DB::transaction(function() {
            $cat = new Cat();

            $cat->id_author = Auth::id();
            $cat->content = Input::get('comment');
            $cat->position = Input::get('position.latitude') . ',' . Input::get('position.latitude');
            $cat->save();

            $photos = Input::get('photos');
            if ( count($photos) > 0 ){

                $photoModels = array();
                foreach ($photos as $photo) {
                    $tempArr = explode(DIRECTORY_SEPARATOR, $photo);
                    $photo = end( $tempArr );
                    $photoModels[] = new Photo( array('path'=>$photo) );
                }
                $cat->photos()->saveMany($photoModels);
            }
        });

        return Response::json(array('success'=>true));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $cat = Cat::with('likes', 'author', 'photos')->find($id);
        if (is_null($cat)) {
            return Response::answer([], false);
        } else {
            $data = $cat->formatPosition();
            return Response::answer($data);
        }
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
		//
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
