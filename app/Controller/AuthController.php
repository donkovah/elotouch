<?php
namespace App\Controller;

use App\Service\AuthService;

class Authcontroller
{
    protected $auth;

    public function __construct() {
        $this->auth = new AuthService;
    }

    public function login()
    {
        $token =  $this->auth->login();
        echo json_encode(['status' => 200, 'data' => $token]);
    }

}