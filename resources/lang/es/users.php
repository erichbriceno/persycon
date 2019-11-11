<?php

return [
    'roles' => ['master' => 'Maestro', 'admin' => 'Administrador', 'user' => 'Usuario'],
    'filters' => [
        'roles' => ['master' => 'Maestro', 'admin' => 'Administrador', 'user' => 'Usuario'],
        'states' => ['all' => 'Todos', 'active' => 'Activos', 'inactive' => 'Inactivos'],
    ],
    'state' => ['active' => 'Activo', 'inactive'=> 'Inactivo'],
    'emptyMessage' => [
        'index' => 'No hay usuarios registrados',
        'trash' => 'No hay usuarios eliminados'
    ]
];
