<?php

namespace CatSearch\ModelObserver;

use CatSearch\Facades\Image;


class PhotoObserver {

    public function creating($photo)
    {
        Image::build($photo->path, 'big');
        Image::build($photo->path, 'medium');
        Image::build($photo->path, 'small');
    }

} 