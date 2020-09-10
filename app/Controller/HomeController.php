<?php
namespace App\Controller;

use Mobnia\Database\{PeopleMigration, Seeds, TicketsMigration, UserMigration};

class HomeController
{
    public function index()
    {
        if (!file_exists(__DIR__.'ready.txt')) {
            (new UserMigration)->migrate();
            (new PeopleMigration)->migrate();
            (new TicketsMigration)->migrate();
            file_put_contents(__DIR__.'ready.txt', "Your App is now Ready");
        }

        echo json_encode(['status' => 200, 'message' => "Congratulations!!! Your API is ready to go"]);
    }

    public function seedTable()
    {
        (new Seeds)->runSeeder();
        echo json_encode(['status' => 200, 'message' => "Congratulations!!! Your database has been seeded"]);
    }

    

}