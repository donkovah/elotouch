<?php
namespace Mobnia;

use Exception;
use Mobnia\Contracts\RouterInterface;

class Request
{

    public static function uri($var = null)
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }


    public static function method($var = null)
    {
        return trim($_SERVER['REQUEST_METHOD'], '/');
    }

    
}