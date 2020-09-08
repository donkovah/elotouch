<?php

use Mobnia\Request;
use Mobnia\Router;

//  Autoload composer
require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/core/Bootstrap.php';

$router = new Router;
$router->load('routes');

try {
  header('Content-Type: application/json;charset=utf-8');
  return $router->dispatch(Request::uri(), Request::method());
} catch (\Throwable $th) {
  // var_dump($th); die;
  echo json_encode(['status' => 400, 'message' => $th->getMessage()]);
}
