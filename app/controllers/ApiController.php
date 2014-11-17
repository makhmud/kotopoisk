<?php

class ApiController extends BaseController {

	public function upload() {
        $request = new \Flow\Request();

        $filename = Input::get('flowTotalSize') . '-' . Input::get('flowFilename');
        $tmpDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR;
        $destination = $tmpDir . $filename;
        $config = new \Flow\Config(array(
            'tempDir' => sys_get_temp_dir()
        ));
        $file = new \Flow\File($config, $request);
        $response = Response::make('', 200);

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!$file->checkChunk()) {
                return Response::make('', 404);
            }
        } else {
            if ($file->validateChunk()) {
                $file->saveChunk();
            } else {
                return Response::make('', 400);
            }
        }
        if ($file->validateFile() && $file->save($destination)) {

            if (Input::has('isUserPic')) {
                Image::make($destination)->fit(1366, 800)->blur(15)->brightness(-50)->save($tmpDir . 'blured-' . $filename);
            }

            $response = Response::make($destination, 200);
        }

        return $response;

    }

    public function getUserPic() {

        $bluredPrefix = !Input::has('notBlured') ? 'blured-' : '';

        $defaulPath = public_path() . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . $bluredPrefix . 'default.png';

        $destination =  public_path() . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . $bluredPrefix . Input::get('destination');

        if (!file_exists($destination)) {
            $destination = Input::get('destination');
            $parts = explode(DIRECTORY_SEPARATOR, $destination);
            $parts[count($parts)-1] = $bluredPrefix . $parts[count($parts)-1];
            $destination = implode(DIRECTORY_SEPARATOR, $parts);
        }

        if(file_exists($destination)) {
            return Image::make($destination)->response();
        } else {
            return Image::make($defaulPath)->response();
        }

    }

}
