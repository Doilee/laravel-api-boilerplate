<?php

namespace App\Http\Controllers;

/***
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController
{
    /**
     * @return string
     */
    public function version()
    {
        return app()->version();
    }
}