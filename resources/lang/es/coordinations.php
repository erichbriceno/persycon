<?php

return [
    'emptyMessage'  => [
        'index'             => 'No hay coordinaciones creadas',
        'trash'             => 'No hay coordinaciones borradas'
    ],
    'fieldsPlaceholder' => [
        'name'              => 'Nombre de la coordinación (máx. 25 caracteres)',
        'description'       => 'Descripción de la coordinación (máx. 50 caracteres)',
        ],
    'errorsValidations' => [
        'name' => [
            'uniqueName'    => 'El nombre ":name" ya existe.', 
        ],
        'description' => [
            'max'           => 'La descripción no debe ser mayor que 50 caracteres.'
        ],
    ]
    /*
    'state'     => [
        'inactive'          => 'Inactivo',
        'active'            => 'Activo'
    ],
    */
];