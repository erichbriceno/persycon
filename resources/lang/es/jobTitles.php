<?php

return [
    'emptyMessage'  => [
        'index'             => 'No hay cargos creados',
        'trash'             => 'No hay cargos borrados'
    ],
    'fieldsPlaceholder' => [
        'name'              => 'Nombre del cargo (máx. 25 caracteres)',
        'description'       => 'Describa del cargo (máx. 50 caracteres)',
        ],
    'state'     => [
        'inactive'          => 'Inactivo',
        'active'            => 'Activo'
        ],
    'errorsValidations' => [
        'name' => [
            // 'required'      => 'El nombre es obligatorio.',
        ],
        'description' => [
            'max'           => 'La descripción no debe ser mayor que 50 caracteres.'
        ],
    ],
];