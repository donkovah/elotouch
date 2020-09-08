<?php
namespace Mobnia;

use App\Controller\HomeController;
use Exception;
use Mobnia\Contracts\RouterInterface;



class Router implements RouterInterface
{
    protected $router = [];

    public function load($file) {
        try {
            $this->register(require $file.'.php');
        } catch (\Throwable $th) {
            throw new Exception('Routes file not found');
        }
    }

    public function register($routes)
    {
        $this->router = $routes;
    }

    public function dispatch($route, $method)
    {
        $splitRoute = explode('/', $route);
        switch (count($splitRoute)) {
            case 1:
                if(!isset($this->router[$splitRoute[0]])){
                    throw new Exception("Invalid route path");
                }
                $this->resolve($this->router[$splitRoute[0]], $method);
                break;
            case 2:
                if(!isset($this->router[$splitRoute[0]])){
                    throw new Exception("Invalid route path");
                }
                $this->resolve($splitRoute, $method, $splitRoute[1]);
                break;
            default:
                throw new Exception("Invalid route path");
                break;
        }
    }

    protected function resolve($request, $method, $param = null)
    {
        if ($param) {
            $controller = "";
            $method = '';
            foreach ($this->router as $key => $value) {
                $splitKey = explode('/', $key);
                if(count($splitKey) > 1){
                    $arg = explode('@', $value[1]);
                    $controller = "\\App\\Controller\\".$arg[0];
                    $method = $arg[1];            
                    break;
                }
            }
        } else {
            if ($request[0] !== $method) {
                throw new Exception("Request method do not match");
            }        
            $arg = explode('@', $request[1]);
            $controller = "\\App\\Controller\\".$arg[0];
            $method = $arg[1];
        }
        if (class_exists($controller)) {
            $controllerClass = new $controller;
            if (method_exists($controllerClass, $method)) {
                if ($param) {
                    $controllerClass->$method($param);
                }else{
                    $controllerClass->$method();
                }
            } else{
                throw new Exception('Invalid class method');
            }
        } else{
            throw new Exception('Controller class does not exist');
        }
    }
}
