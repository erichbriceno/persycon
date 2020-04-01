<?php

return [
    'emptyMessage'  => [
        'index'             => 'There are no projects created',
        'trash'             => 'There are no projects deleted'
    ],
    'fieldsPlaceholder' => [
        'name'              => 'Must contain a single word.',
        'description'       => 'Proyect descrption (50 characters max.).',
        ],
    'errorsValidations' => [
        'name' => [
            'required'      => 'The name field is mandatory.',
            'nameProject'   => 'The name must contain a single word.',
            'alpha'         => 'Allows only alphabetic characters. [A-z].',
            'uniqueName'    => 'The name ":name" already exists.', 
        ],
        'year' => [
            'required'      => 'Year field is mandatory.',
            'yearBetween'   => 'Valid :year ± 1.'
        ],
        'description' => [
            'max'           => 'The description may not be greater than 50 characters.'
        ],
        'date' => [
            'start'         => 'start',
            'required'      => 'The :time date is mandatory.',
            'date_format'   => 'Valid format dd/mm/yyyy.',
            'after'         => 'Valid date after :time',
            'before'        => 'Valid date before :time',
            'toAfter'       => 'Must be after the start date',
        ]
    ],
];