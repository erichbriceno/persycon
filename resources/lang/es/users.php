<?php

return [
    'roles'     => ['master' => 'Maestro', 'admin' => 'Administrador', 'user' => 'Usuario'],
    'filters'   => [
        'roles'     => ['master' => 'Maestro', 'admin' => 'Administrador', 'user' => 'Usuario'],
        'states'    => ['active' => 'Activos', 'inactive' => 'Inactivos', 'all' => 'Todos'],
    ],
    'emptyMessage'  => [
        'index'     => 'No hay usuarios registrados',
        'trash'     => 'No hay usuarios eliminados'
    ],
    'fields'    => [
        'placeholder' => [
            'cedule'    => 'V12345678 - E81000000',
            'email'     => 'usuario@correo.com',
            'password'  => 'Debe contener mínimo 6 caracteres',
        ],
    ],
    'errorsValidations' => [
        'required'  => 'El campo :field es obligatorio.',
    ],
];
