<?php
namespace App\Service;

use App\Traits\PeopleTraits;
use Mobnia\Contracts\AuthServiceInterface;

class PeopleService implements AuthServiceInterface
{
    use PeopleTraits;
}