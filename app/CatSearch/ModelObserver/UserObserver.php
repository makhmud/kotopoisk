<?php

namespace CatSearch\ModelObserver;

use CatSearch\Facades\Image;


class UserObserver {

    public function saving($user) {

        if (!$user->image) {
            $user->image = 'default.png';
        } else {
            $destination = $user->image;
            $parts = explode(DIRECTORY_SEPARATOR, $destination);
            $user->image = $parts[count($parts)-1];

            $tmpPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $user->image;
            $tmpBluredPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'blured-' . $user->image;

            if (file_exists($tmpPath) && file_exists($tmpBluredPath)) {
                Image::make($tmpPath)->save( public_path() . DIRECTORY_SEPARATOR . 'user/'.$user->image );
                Image::make($tmpBluredPath)->save( public_path() . DIRECTORY_SEPARATOR . 'user/blured-' . $user->image );
            }
        }

    }

} 