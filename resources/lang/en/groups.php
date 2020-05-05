<?php

return [
    'emptyMessage'  => [
        'index'             => 'There are no groups created',
        'trash'             => 'There are no groups deleted'
    ],
    'fieldsPlaceholder' => [
        'name'              => 'Group name (25 characters max.)',
        'description'       => 'Group description (50 characters max.)',
        ],
    'errorsValidations' => [
        'name' => [
            'uniqueName'    => 'The name ":name" already exists.', 
        ],
        'description' => [
            'max'           => 'The description may not be greater than 50 characters.'
        ],
    ]
    /*
    'state'     => [
        'inactive'          => 'Inactive',
        'active'            => 'Active'
    ],
    */
];