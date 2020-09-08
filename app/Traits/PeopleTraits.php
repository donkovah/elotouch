<?php
namespace App\Traits;

use App\Person;

trait PeopleTraits
{
    public function getPeople()
    {
        $people = Person::get();
        return $people;
    }

    public function showPerson($id)
    {
        $people = Person::where('id', '=', $id)->with('tickets')->first();
        return $people;
    }
}