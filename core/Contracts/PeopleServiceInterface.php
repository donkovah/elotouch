<?php

namespace Mobnia\Contracts;

interface PeopleServiceInterface
{
    public function getPeople();
    public function showPerson($personId);
}