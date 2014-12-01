<?php
/**
 * Created by PhpStorm.
 * User: geronimo
 * Date: 01.12.14
 * Time: 16:43
 */

class AdminBaseController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth.admin' );
        $this->layout = 'admin._layout';
    }

} 