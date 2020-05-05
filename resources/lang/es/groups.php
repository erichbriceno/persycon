<?php

return [
    'emptyMessage'  => [
        'index'             => 'No hay grupos creados',
        'trash'             => 'No hay grupos borrados'
    ],
    'fieldsPlaceholder' => [
        'name'              => 'Nombre del grupo (máx. 25 caracteres)',
        'description'       => 'Descripción del grupo (máx. 50 caracteres)',
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