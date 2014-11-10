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

//            Image::make($destination)->blur()->save(storage_path() . '/files/flow/uploads/temp.jpg');

            $response = Response::make($destination, 200);
        }

        return $response;


    }

}
