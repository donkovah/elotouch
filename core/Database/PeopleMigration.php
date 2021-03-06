<?php
namespace Mobnia\Database;

require dirname(__DIR__, 1)."/bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

class PeopleMigration{
    public function migrate()
    {
        Capsule::schema()->create('people', function ($table) {
               $table->increments('id');
               $table->string('name');
               $table->timestamps();
           });
    }

}