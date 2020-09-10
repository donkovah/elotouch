<?php
namespace App\Service;

use App\Traits\ValidateTraits;
use Mobnia\Contracts\ValidateUserInterface;

class ValidateService implements ValidateUserInterface
{
    use ValidateTraits;
}