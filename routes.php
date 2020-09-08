<?php

return [
    'mobnia' => ['GET', 'HomeController@index'],
    'people' => ['GET', 'PeopleController@index'],
    'people/:id' => ['GET', 'PeopleController@show'],
    'auth/' => ['POST', 'AuthController@login'],
];