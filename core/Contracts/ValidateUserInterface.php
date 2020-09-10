<?php

namespace Mobnia\Contracts;

interface ValidateUserInterface
{
    public static function validateUser($token = null);
}