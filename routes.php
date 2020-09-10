<?php

return [
    'migrate' => ['GET', 'HomeController@index'],
    'seed' => ['GET', 'HomeController@seedTable'],
    'people' => ['GET', 'PeopleController@index'],
    'people/:id' => ['GET', 'PeopleController@show'],
    'login' => ['POST', 'AuthController@login'],
];