<?php
namespace Mobnia\Database;

require dirname(__DIR__, 1)."/bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

class PeopleMigration{
    public function migrate()
    {
        Capsule::schema()->create('movie', function ($table) {
               $table->increments('id');
               $table->string('name');
               $table->string('email')->unique();
               $table->string('password');
               $table->string('userimage')->nullable();
               $table->string('api_key')->nullable()->unique();
               $table->rememberToken();
               $table->timestamps();
           });
    }

}