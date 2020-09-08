<?php
namespace App\Controller;

use Mobnia\Database\{PeopleMigration, TicketsMigration};

class HomeController
{
    public function index()
    {
        if (!file_exists(__DIR__.'ready.txt')) {
            (new PeopleMigration)->migrate();
            (new TicketsMigration)->migrate();
            file_put_contents(__DIR__.'ready.txt', "Your App is now Ready");
        }

        echo json_encode(['status' => 200, 'message' => "Congratulations!!! Your API is ready to go"]);
    }
}