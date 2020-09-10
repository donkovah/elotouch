<?php
namespace App\Service;

use App\Traits\AuthTraits;
use Mobnia\Contracts\AuthServiceInterface;
use Mobnia\Contracts\ValidateUserInterface;

class AuthService implements AuthServiceInterface
{
    use AuthTraits;
}