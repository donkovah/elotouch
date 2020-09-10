<?php
namespace Mobnia\Database;

use App\{User, Person};
use Mobnia\Database\Seeds\UserSeeds;
use Mobnia\Database\Seeds\PeopleSeeds;

Class Seeds
{
  protected $users = [];
  protected $people = [];

  public function __construct() {
    $this->users = UserSeeds::returnData();
    $this->people = PeopleSeeds::returnData();
  }

  public function runSeeder()
  {
    try {
      foreach ($this->users as $key => $user) {
        User::create($user);
      }
      foreach ($this->people as $key => $person) {
        Person::create(['name' => $person['name']]);
      }
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}