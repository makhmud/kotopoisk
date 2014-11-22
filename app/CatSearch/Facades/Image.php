<?php
namespace CatSearch\Facades;

use Intervention\Image\Facades\Image as BaseImage;

/**
 * Image class extension for custom needs
 * Class Image
 * @package CatSearch\Facades
 */
class Image extends BaseImage {

    public static function config( $key ) {
        return \Config::get('image.' . $key);
    }

    /**
     * Builds path to image of given format
     * @param $filename
     * @param null $format
     * @param string $type
     * @return string
     */
    public static function path( $filename, $format = null, $type = 'public' ){

        $directory = self::config('directories.'. $type .'.path');

        if (is_null($format)) {
            $prefix = '';
        } else {
            $prefix = self::config('formats.'. $format .'.prefix');
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

    public static function format ( $filename, $format ) {

        $image = Image::make(self::temp($filename));

        $width = self::config('formats.'. $format .'.width');
        $height = self::config('formats.'. $format .'.height');

        $image->fit($width, $height);

        $additionalMethods = self::config('formats.'. $format .'.methods');

        if ( !is_null($additionalMethods) ){
            foreach( $additionalMethods as $method ) {
                $image = call_user_func_array( [$image, $method[0]], $method[1] );
            }
        }

        return $image;
    }

    /**
     * Saves image with given format
     * @param $filename
     * @param $format
     * @return mixed
     */
    public static function build ( $filename, $format ) {

        return self::format( $filename, $format )->save( self::path($filename, $format, 'public') );

    }

} 