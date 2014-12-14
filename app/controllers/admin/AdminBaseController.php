<?php

class AdminBaseController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth.admin' );
        $this->layout = 'admin._layout';
    }

} 