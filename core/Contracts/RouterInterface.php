<?php

namespace Mobnia\Contracts;

interface RouterInterface
{
    public function load($routes);
    public function register($routes);
    public function dispatch($route, $method);
}