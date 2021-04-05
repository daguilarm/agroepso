<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Default
    |--------------------------------------------------------------------------
    */
    'default' => 'Cliente|Clientes',
    'description' => 'Listado de clientes activos en la aplicación',
    'forms' => [
        'create' => 'Crear nuevos clientes',
        'update' => 'Actualizar la información de los clientes',
        ////////////////////////
        'label-options' => 'Opciones',
        'label-contact' => 'Datos de contacto',
        'label-image' => 'Imagen corporativa',
        'label-irrigation' => 'Listado de riegos disponibles',
        'label-module' => 'Listado de modulos disponibles',
        'label-region' => 'Listado de provincias',
        'label-training' => 'Listado de conducciones',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Tabs
    |--------------------------------------------------------------------------
    */
   'tabs' => [
        'data' => 'Información General',
        'regions' => 'Provincias',
        'options' => 'Opciones agronómicas',
        'modules' => trans_title('modules', 'plural') . ' personalizados',
   ],
];