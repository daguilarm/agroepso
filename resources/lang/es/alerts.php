<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    */
    'client' => [
        'confirm' => '¿Seguro que quiere cambiar de cliente?',
        'msg' => [
            'Introduzca el nombre del cliente y el sistema le irá haciendo sugerencias.',
            'Haga click sobre el cliente y automáticamente se le asignará a ese cliente.'
        ],
    ],
    'database' => [
        'msg' => [
            'Se ha producido un error en la base de datos.',
            'Estos errores suelen ser puntuales, por favor, inténtelo de nuevo, en unos segundos.',
            'Si el error persiste, contacte con el administrador del sistema, con la siguiente referencia:'
        ],
        'type' => [
            'create' => 'DB#ERROR-' . time() . '-' . date('d-m-Y') .' - Error al crear un elemento',
            'update' => 'DB#ERROR-' . time() . '-' . date('d-m-Y') .' - Error al actualizar un elemento',
            'delete' => 'DB#ERROR-' . time() . '-' . date('d-m-Y') .' - Error al borrar un elemento',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    'delete' => [
        'confirm'           => '¿Seguro que quiere eliminarlo?',
        'default'           => 'Eliminar',
        'msg' => [
            'Si elimina el elemento, no podrá recuperarlo.',
            'Se trata de un proceso irreversible. ¿Está seguro?',
        ],
        'restore'           => 'El elemento se ha recuperado correctamente',
        'self-destruction'  => 'No puede borrarse a sí mismo...',
        'success'           => 'El elemento se ha borrado correctamente',
    ],

    /*
    |--------------------------------------------------------------------------
    | Errors
    |--------------------------------------------------------------------------
    */
    'errors' => [
        'default' => 'Error',
        'title' => 'Se ha producido un error al realizar la operación.',
        'notAllowed' => [
            'No está autorizado a realizar esta acción.',
            'Verifique que tiene los permisos adecuados para realizarla.',
            'Si el error persiste, contacte con el administrador del sistema.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Excel
    |--------------------------------------------------------------------------
    */
    'excel' => [
        'success' => 'Los datos se han volcado correctamente desde el archivo excel. El proceso puede tardar varios minutos.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Resset
    |--------------------------------------------------------------------------
    */
    'reset' => [
        'success' => 'Los datos se han reiniciado correctamente. El proceso puede tardar varios minutos en aparecer en el sistema.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */
    'success' => [
        'default' => 'Éxito',
        'title' => 'La operación se ha realizado con éxito',
    ],

    /*
    |--------------------------------------------------------------------------
    | Updated
    |--------------------------------------------------------------------------
    */
    'updated' => [
        'default' => 'Modificar',
        'title' => 'La base de datos se ha actualizado con éxito',
    ],
];
