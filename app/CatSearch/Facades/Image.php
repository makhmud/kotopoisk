<?php
namespace CatSearch\Facades;

use Intervention\Image\Facades\Image as BaseImage;


class Image extends BaseImage {

//    public function __call($function, $args){
//
//        switch ($function){
//            case 'temporary'
//        }
//
//    }

    public static function path( $filename, $format = null, $type = 'public' ){

        $directory = \Config::get('image.directories.'. $type .'.path');

        if (is_null($format) || $type == 'temporary') {
            $prefix = '';
        } else {
            $prefix = \Config::get('image.formats.'. $format .'.prefix');
        }

        return $directory . $prefix . $filename;

    }

    public static function temp( $filename ) {

        return self::path($filename, null, 'temporary');

    }

    public static function build ( $filename, $format ) {

        $image = Image::make(self::temp($filename));

        $width = \Config::get('image.formats.'. $format .'.width');
        $height = \Config::get('image.formats.'. $format .'.height');

        $additionalMethods = \Config::get('image.formats.'. $format .'.methods');

        if ( !is_null($additionalMethods) ){
            foreach( $additionalMethods as $method ) {
                $image = call_user_func_array( [$image, $method[0]], $method[1] );
            }
        }

        return $image->save( self::path($filename, $format, 'public') );

    }

} 