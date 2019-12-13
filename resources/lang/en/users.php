<?php

return [
    'roles'     => ['master' => 'Master', 'admin' => 'Admin', 'user' => 'User'],
    'filters'   => [
        'roles'     => ['master' => 'Master', 'admin' => 'Admin', 'user' => 'User'],
        'states'    => ['active' => 'Active', 'inactive' => 'Inactive', 'all' => 'All'],
    ],
    'state'     => ['inactive'=> 'Inactive', 'active' => 'Active'],
    'emptyMessage'  => [
        'index'     => 'There are no registered users',
        'trash'     => 'There are no users deleted'
    ],
    'fields'    => [
        'cedule'    => 'V12345678 - E81000000 - 12345678',
        'email'     => 'example@mail.com',
        'password'  => 'Must contain a minimum of 6 characters',
    ]
];

