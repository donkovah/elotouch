<?php
namespace App\Controller;

use App\Service\PeopleService;
use App\Service\ValidateService;

class PeopleController
{
    protected $service;

    public function __construct() {
        ValidateService::validateUser(); // All routes are protected
        $this->service = new PeopleService();
    }

    public function index()
    {
        $people = $this->service->getPeople();
        echo json_encode(['status' => 200, 'data' => $people]);
    }

    public function show($personId = 1)
    {
        $person = $this->service->showPerson($personId);
        echo json_encode(['status' => 200, 'data' => $person]);
    }

}