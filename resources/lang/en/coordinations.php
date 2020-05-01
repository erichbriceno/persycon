<?php

return [
    'emptyMessage'  => [
        'index'             => 'There are no coordinations created',
        'trash'             => 'There are no coordinations deleted'
    ],
    'fieldsPlaceholder' => [
        'name'              => 'Coordination name (25 characters max.)',
        'description'       => 'Coordination description (50 characters max.)',
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