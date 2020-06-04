<?php

return [
    'emptyMessage'  => [
        'index'             => 'There are no job titles created',
        'trash'             => 'There are no job titles deleted'
    ],
    'fieldsPlaceholder' => [
        'name'              => 'Job title name (25 characters max.)',
        'description'       => 'Job title descrption (50 characters max.).',
        ],
    'state'     => [
        'inactive'          => 'Inactive',
        'active'            => 'Active'
    ],
    'errorsValidations' => [
        'name' => [
            // 'required'      => 'The name field is mandatory.',
        ],
        'description' => [
            'max'           => 'The description may not be greater than 50 characters.'
        ],
    ],
];