<?php
namespace CatSearch\Facades;

use Illuminate\Support\Facades\Response as BaseResponse;

/**
 * Custom response class
 * Class Response
 * @package CatSearch\Facades
 */
class Response extends BaseResponse {

    /**
     * Standart success flag
     * @var bool
     */
    private static $_success = true;

    /**
     * Errors array
     * @var array
     */
    private static $_errors = array();

    /**
     * Standart response method, returns json response
     * including errors array and success flag
     * @param $data
     * @param bool $success
     * @param array|string $error
     * @return \Illuminate\Http\JsonResponse
     */
    public static function answer($data, $success = true, $error = array() ){

        self::$_success = $success;

        if ( is_string($error) ) {
            self::$_errors[] = $error;
        } elseif ( is_array($error) && !empty($error) ) {
            self::$_errors = array_merge( self::$_errors, $error );
        }

        return self::json(
            array(
                'data' => $data,
                'success' => self::$_success,
                'errors' => self::$_errors
            )
        );

    }

} 