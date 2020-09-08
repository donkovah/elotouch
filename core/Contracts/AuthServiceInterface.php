<?php

namespace Mobnia\Contracts;

interface AuthServiceInterface
{
    public function login();
    public function validate($token);
}