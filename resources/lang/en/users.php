<?php

return [
    'roles' => ['master' => 'Master', 'admin' => 'Admin', 'user' => 'User'],
    'filters' => [
        'roles' => ['master' => 'Master', 'admin' => 'Admin', 'user' => 'User'],
        'states' => ['active' => 'Active', 'inactive' => 'Inactive', 'all' => 'All'],
    ],
    'state' => ['active' => 'Active', 'inactive'=> 'Inactive'],
    'emptyMessage' => [
        'index' => 'There are no registered users',
        'trash' => 'There are no users deleted'
    ]
];

