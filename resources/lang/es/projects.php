<?php

return [
    'emptyMessage'  => [
        'index'             => 'No hay proyectos creados',
        'trash'             => 'No hay proyectos borrados'
    ],
    'fieldsPlaceholder' => [
        'name'              => 'Debe contener una sola palabra',
        'description'       => 'Describa el proyecto (máx. 50 caracteres)',
        ],
    'errorsValidations' => [
        'name' => [
            'required'      => 'El nombre es obligatorio.',
            'nameProject'   => 'El nombre debe contener una sola palabra.',
            'alpha'         => 'Permite solo caracteres alfabéticos. [A-z]',
            'uniqueName'    => 'El nombre ":name" ya existe.',
        ],
        'year' => [
            'required'      => 'El año es obligatorio',
            'yearBetween'   => 'Valido :year ± 1',
        ],
        'description' => [
            'max'           => 'La descripción no debe ser mayor que 50 caracteres.'
        ],
        'date' => [
            'start'         => 'inicio',
            'required'      => 'La fecha de :time es obligatoria.',
            'date_format'   => 'Formato valido dd/mm/yyyy',
            'after'         => 'Fecha valida posterior a :time',
            'before'        => 'Fecha valida anterior a :time',
            'toAfter'       => 'Debe ser posterior a la fecha de inicio',
        ]
    ],
];