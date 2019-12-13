<?php

return [
    'roles' => ['master' => 'Maestro', 'admin' => 'Administrador', 'user' => 'Usuario'],
    'filters' => [
        'roles' => ['master' => 'Maestro', 'admin' => 'Administrador', 'user' => 'Usuario'],
        'states' => ['active' => 'Activos', 'inactive' => 'Inactivos', 'all' => 'Todos'],
    ],
    'state' => ['inactive'=> 'Inactivo', 'active' => 'Activo'],
    'emptyMessage' => [
        'index' => 'No hay usuarios registrados',
        'trash' => 'No hay usuarios eliminados'
    ]
];
