<?php

return [

     /*
     |--------------------------------------------------------------------------
     | Alert
     |--------------------------------------------------------------------------
     */
    'alert' => [
          'confirm' => '¿Está seguro que quiere resetear todas las parcelas?',
          'messages' => [
                'El proceso no es reversible.',
                'Una vez reinicie todas las parcelas, estas aparecerán como no activas.',
                'Tendrá que activarlas una a una para recuperar su estado.'
          ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default
    |--------------------------------------------------------------------------
    */
    'auto' => 'Si lo deja en blanco, se generará un nombre automático. Ejemplo: Parcela Nº XXXXXX',
    'default' => 'Parcela|Parcelas',
    'description' => 'Información sobre parcelas agrícolas',
    'forms' => [
        'alert' => 'A todas las parcelas del archivo, se les asignará esta variedad',
        'create' => 'Crear nueva parcela',
        'framework' => 'Se utiliza para calcular el número de árboles/cepas. Si lo deja en blanco, no podrá realizarse.',
        'quantity' => 'Este dato se puede calcular automáticamente',
        'sigpac' => 'Si lo deja en blanco, se asignará el valor del SIGPAC',
        'update' => 'Actualizar parcela',
        ////////////////////////
        'label' => 'Información de parcela',
        'label-crop' => 'Datos del cultivo',
        'label-excel'  => 'Archivo excel',
        'label-geolocation' => 'Datos de geolocalización',
        'label-optional' => 'Datos opcionales',
        'label-weather' => 'Datos climáticos',
    ],
    'name' => 'Parcela Nº',

    /*
    |--------------------------------------------------------------------------
    | Excel
    |--------------------------------------------------------------------------
    */
    'excel' => [
        'info' => [
            ['Referencia', 'Es el identificador de la parcela. Si lo deja en blanco, se le asignará un número consecutivo'],
            ['Usuario', 'Es el identificador del dueño de la parcela. Puede encontrarlo en la sección de usuarios, bajo el epígrafe "código". ' . highlight_text('También se puede utilizar el email del usuario')],
            ['Planta', 'Este campo es optativo. Complételo solo, si utilizan plantas de procesado (y desean referenciarlas). Si es así, asígnele el código de referencia de la planta'],
            ['Almacén', 'Este campo es optativo. Complételo solo, si utilizan almacenes (y desean referenciarlos). Si es así, asígnele el código de referencia del almacén'],
            ['Nombre parcela', 'Es el nombre que le asigna a la parcela. Si lo deja en blanco se le asignará uno automático'],
            ['Región', 'Campo referido al SIGPAC. Es obligatorio.'],
            ['Ciudad', 'Campo referido al SIGPAC. Es obligatorio.'],
            ['Agregado', 'Campo referido al SIGPAC. Suele ser 0, por lo que no es necesario rellenarlo. Puede dejarlo en blanco'],
            ['Zona', 'Campo referido al SIGPAC. Suele ser 0, por lo que no es necesario rellenarlo. Puede dejarlo en blanco'],
            ['Polígono', 'Campo referido al SIGPAC. Es obligatorio'],
            ['Parcela', 'Campo referido al SIGPAC. Es obligatorio'],
            ['Recinto', 'Campo referido al SIGPAC. Puede dejarlo en blanco'],
            ['Area', 'Superficie en ' . highlight_text('hectáreas (ha)') . ' de la parcela. Si lo deja en blanco se le asignará uno automático a partir del SIGPAC'],
            ['Total', 'Número total de árboles o cepas en la parcela. Puede dejarlo en blanco'],
            ['Producción', 'Última producción en ' . highlight_text('Kg') . ' de la parcela. Puede dejarlo en blanco'],
            ['Marco x', 'Marco de plantación. Distancia entre plantas. Es optativo, pero altamente recomendado'],
            ['Marco y', 'Marco de plantación. Separación entre líneas. Es optativo, pero altamente recomendado'],
            ['Cubierta', '¿La parcela dispone de cubierta vegetal? Es un campo optativo. Admite los valores: ' . selectBoolean(null, $toString = true) . '. Si lo deja en blanco se asigna: NO'],
            ['Conducción', 'Tipo de conducción de su cultivo. Es un campo optativo. Admite los valores: ' . selectTraining(null, $toString = true)],
            ['Balsa', '¿La parcela dispone de una balsa de riego? Es un campo optativo. Admite los valores: ' . selectBoolean(null, $toString = true) . '. Si lo deja en blanco se asigna: NO'],
            ['Carretera', 'Tipo de carretera de acceso a la parcela. Es un campo optativo. Admite los valores:' . selectRoad(null, $toString = true) . '. Si lo deja en blanco se asigna: NO'],
            ['Fecha', 'Año de plantación de la parcela. ' . highlight_text('Indicar solo el año') . '. Es un campo optativo. En formato: ' . highlight_text('AAAA')],
            ['Dop', 'Determinar si la parcela está bajo DOP. Es un campo optativo. Admite los valores: ' . selectBoolean(null, $toString = true)],
            ['IGP', 'Determinar si la parcela está bajo IGP. Es un campo optativo. Admite los valores: ' . selectBoolean(null, $toString = true)],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | General
    |--------------------------------------------------------------------------
    */
    'area' => 'Superficie',
    'green_cover' => 'Cubierta vegetal',
    'code' => 'Código parcela',
    'cultivated_land' => '% Cultivado',
    'date' => 'Fecha de plantación',
    'framework_x' => 'Separación de lineas',
    'framework_y' => 'Distacia entre cepas',
    'pond' => 'Balsa',
    'production' => 'Producción',
    'quantity' => 'Nº árboles/cepas',
    'real_area' => 'Superficie Cultivada',
    'road' => 'Carretera',
    'start_date' => 'Año plantación',
    'training' => 'Tipo de conducción',
    'units' => 'Cepas totales',

     /*
     |--------------------------------------------------------------------------
     | Sigpac
     |--------------------------------------------------------------------------
     */
    'sigpac' => [
        'aggregate' => 'Sigpac: Agregado',
        'alert' => [
            'Los datos del SIGPAC: region, ciudad, polígono y parcela, son utilizados para obtener los datos de geolocalización. Si los deja en blanco, no se podrá realizar la operación',
            'El resto de datos, como los opcionales, se pueden obtener a partir del SIGPAC y CATASTRO, de forma automatizada, por lo que no es necesario completarlos',
            'Complete estos datos, solo en el caso de que sean distintos a los que se encuentran en el SIGPAC y el CATASTRO'
        ],
        'city' => 'Sigpac: Ciudad',
        'optional' => 'Este dato es automático',
        'polygon' => 'Sigpac: Polígono',
        'plot' => 'Sigpac: Parcela',
        'precinct' => 'Sigpac: Recinto',
        'region' => 'Sigpac: Región',
        'zone' => 'Sigpac: Zona',
    ],

     /*
     |--------------------------------------------------------------------------
     | Tables
     |--------------------------------------------------------------------------
     */
    'table' => [
          'general' => 'Información',
          'production' => 'Información Producción/Facturación',
    ],
];
