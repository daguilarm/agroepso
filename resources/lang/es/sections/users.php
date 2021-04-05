<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default
    |--------------------------------------------------------------------------
    */
    'default' => 'Socio|Socios',
    'description' => 'Listado de socios con acceso a la aplicación',
    'description-excel' => 'Añadir listado de socios a partir de archivo excel',
    'forms' => [
        'label'  => 'Datos personales',
        'label-access'  => 'Datos de acceso',
        'label-excel'  => 'Archivo excel',
        'label-management'  => 'Datos de gestión',
        ////////////////
        'create' => 'Crear nuevo socio',
        'update' => 'Actualizar y/o modificar socio',
    ],
    /*
    |--------------------------------------------------------------------------
    | Excel
    |--------------------------------------------------------------------------
    */
   'excel' => [
        'info' => [
            ['Nombre', 'introduzca el nombre del usuario/socio. Este campo es obligatorio, si está vacio, el socio no se añade'],
            ['Nif', 'introduzca el NIF o CIF del usuario/socio. Este campo es opcional'],
            ['Referencia', 'es el número de referencia que desea asignar al socio. Puede ser numérico o alfanumérico. Tiene un límite de 5 caracteres. Si lo deja en blanco, el sistema le añadirá un número de orden consecutivo'],
            // ['Planta', 'Referencia (o número) de la planta de procesado. El campo es opcional. El sistema buscará en la base de datos la planta y la referenciará si existe'],
            // ['Almacen', 'Referencia (o número) del almacen. El campo es opcional. El sistema buscará en la base de datos el almacén y lo referenciará si existe'],
            ['Email', 'debe de ser un email válido. Si el email ya se encuentra en la base de datos, el socio no se puede añadir otra vez. Este campo es obligatorio, si está vacio, el usuario no se añade'],
            ['Contraseña', 'constraseña de acceso a la plataforma. Si lo deja en blanco, el sistema genera una aleatoria'],
            ['Nacimiento', 'fecha de nacimiento del socio. En formato DD/MM/AAAA, por ejemplo: 10/12/2001. Este campo es opcional'],
            ['Dirección', 'dirección postal del socio. Este campo es opcional'],
            ['CP', 'código postal del socio. Este campo es opcional'],
            ['CCAA', 'comunidad autónoma del socio. Este campo es opcional'],
            ['Provincia', 'provincia del socio. Este campo es opcional'],
            ['Ciudad', 'ciudad del socio. Este campo es opcional'],
            ['Teléfono', 'teléfono del socio. Este campo es opcional'],
        ],
   ],
];
