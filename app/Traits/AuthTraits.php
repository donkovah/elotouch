<?php
namespace App\Traits;

use App\Person;

trait PeopleTraits
{
    public function login()
    {
        $people = Person::get();
        return $people;
    }

    public function validate($id)
    {
        $people = Person::where('id', '=', $id)->with('tickets')->first();
        return $people;
    }
}