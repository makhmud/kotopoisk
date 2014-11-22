<?php
namespace CatSearch\Facades;

use Intervention\Image\Facades\Image as BaseImage;

/**
 * Image class extension for custom needs
 * Class Image
 * @package CatSearch\Facades
 */
class Image extends BaseImage {

    /**
     * Builds path to image of given format
     * @param $filename
     * @param null $format
     * @param string $type
     * @return string
     */
    public static function path( $filename, $format = null, $type = 'public' ){

        $directory = \Config::get('image.directories.'. $type .'.path');

        if (is_null($format)) {
            $prefix = '';
        } else {
            $prefix = \Config::get('image.formats.'. $format .'.prefix');
        }

        return $directory . $prefix . $filename;

    }

    /**
     * Builds path to temporary image
     * @param $filename
     * @return string
     */
    public static function temp( $filename ) {

        return self::path($filename, null, 'temporary');

    }

    /**
     * Saves image with given format
     * @param $filename
     * @param $format
     * @return mixed
     */
    public static function build ( $filename, $format ) {

        $image = Image::make(self::temp($filename));

        $width = \Config::get('image.formats.'. $format .'.width');
        $height = \Config::get('image.formats.'. $format .'.height');

        $image->fit($width, $height);

        $additionalMethods = \Config::get('image.formats.'. $format .'.methods');

        if ( !is_null($additionalMethods) ){
            foreach( $additionalMethods as $method ) {
                $image = call_user_func_array( [$image, $method[0]], $method[1] );
            }
        }

        return $image->save( self::path($filename, $format, 'public') );

    }

} 