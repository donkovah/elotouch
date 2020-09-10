<?php
namespace Mobnia\Database;

require dirname(__DIR__, 1)."/bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

class UserMigration{
    public function migrate()
    {
        Capsule::schema()->create('users', function ($table) {
               $table->increments('id');
               $table->string('email')->unique();
               $table->string('password');
               $table->timestamps();
           });
    }

}