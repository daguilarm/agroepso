<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default
    |--------------------------------------------------------------------------
    */
    'columns' => 'Información sobre las columnas',
    'download' => 'Copia seguridad',
    'title' => 'Subir excel',
    'file' =>  'Descargue el siguiente archivo excel. Es una plantilla para añadir los datos del archivo excel, al servidor web.',
    /*
    |--------------------------------------------------------------------------
    | Instructions
    |--------------------------------------------------------------------------
    */
    'instructions' => [
        'Añada los usuarios respetando el orden establecido en la plantilla. El programa asigna los datos por orden, por lo que si lo alteramos, no funcionará',
        '<b class="alert alert-info p-0 px-2">'. 'No modifique la primera fila del excel (la que contine los títulos). Si los títulos cambian, el sistema no reconocerá las columnas y no añadirá nada' . '</b>',
        '<b class="alert alert-warning p-0 px-2">'. 'Si alguna columna (no obligatoria) la va a dejar en blanco, puede eliminarla para simplificar su excel' . '</b>',
        'Respete los formatos (cuando se especifiquen)',
        'A continuación, tiene un ejemplo de como debería ser su archivo completado',
    ],
];
