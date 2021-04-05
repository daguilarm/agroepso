<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Sections: biocides
    |--------------------------------------------------------------------------
    */
    'default' => 'Fitosanitario|Fitosanitarios',
    'description' => 'Gestión y aplicación de fitosanitarios',
    'forms' => [
        'create' => 'Crear nuevo producto fitosanitario',
        'update' => 'Editar un producto fitosanitario',
        ////////////////////////
        'label' => 'Información del fitosanitario',
    ],
    /*
    |--------------------------------------------------------------------------
    | General
    |--------------------------------------------------------------------------
    */
   'info'              => 'Información del Fitosanitario',
   'formula'           => 'Formula',
   'register'          => 'Nº de Registro',
   /*
   |--------------------------------------------------------------------------
   | Upload
   |--------------------------------------------------------------------------
   */
    'options' => [
        'default'       => 'Actualización de datos',
        'download'      => 'Descargar archivo de fitosanitarios',
        'folder'        => 'Guardar el archivo en la carpeta :folder',
        'storage'       => 'El archivo se ha descargado. Ahora solo tiene que convertilo en CSV.',
        'success'       => 'La base de datos de fitosanitarios, se ha actualizado con éxito.', 
        'update'        => 'Actualizar base de datos de fitosanitarios',
        'upload'        => 'Subir el nuevo archivo a la base de datos. Se añade automáticamente. El sistema solo añade los nuevos fitosanitarios.',
    ],
    /*
    |--------------------------------------------------------------------------
    | Errors
    |--------------------------------------------------------------------------
    */
    'errors' => [
      'Se ha producido un error al descargar el archivo.',
      'Inténtelo después, tal vez el servidor de origen esta sobrecargado o fuera de linea.',
      'Si el error persiste, contacte con el administrador del sistema.'
    ],
];