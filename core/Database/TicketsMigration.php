<?php
namespace Mobnia\Database;

require dirname(__DIR__, 1)."/bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

class TicketsMigration{
    public function migrate()
    {
        Capsule::schema()->create('tickets', function ($table) {
               $table->increments('id');
               $table->string('person_id');
               $table->string('name');
               $table->timestamps();
           });
    }
}