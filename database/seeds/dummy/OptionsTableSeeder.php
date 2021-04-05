<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->delete();

        DB::table('options')->insert([
            [
                'option_name' => 'Marco plantación',
                'option_key' => 'plot-framework',
                'option_category' => 'plot',
                'option_description' => 'Marco de plantación del cultivo',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Cantidad de árboles/cepas',
                'option_key' => 'plot-quantity',
                'option_category' => 'plot',
                'option_description' => 'Número de árboles y cepas en la parcela',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Año de plantación',
                'option_key' => 'plot-date',
                'option_category' => 'plot',
                'option_description' => 'Año de plantación del cultivo',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Producto bajo IGP',
                'option_key' => 'plot-igp',
                'option_category' => 'plot',
                'option_description' => 'El producto se encuentra bajo la protección de un IGP',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Producto bajo DOP',
                'option_key' => 'plot-dop',
                'option_category' => 'plot',
                'option_description' => 'El producto se encuentra bajo la protección de una DOP',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Geolocalización',
                'option_key' => 'plot-geolocation',
                'option_category' => 'plot',
                'option_description' => 'Información de geolocalización de la parcela',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Balsa/Depósito',
                'option_key' => 'plot-pond',
                'option_category' => 'plot',
                'option_description' => 'La parcela tiene acceso a una balsa o depósito',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Carretera/Acceso',
                'option_key' => 'plot-road',
                'option_category' => 'plot',
                'option_description' => 'Información sobre la vía de acceso a la parcela',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Reininciar parcelas',
                'option_key' => 'plot-reset',
                'option_category' => 'plot',
                'option_description' => 'Resetea el campo "Activo" de las parcelas, dejándolas todas inactivas',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Tipo de cultivo',
                'option_key' => 'crop-type',
                'option_category' => 'crop',
                'option_description' => 'Tipo de cultivo. Por ejemplo: uva tinta o blanca',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Variedad de cultivo',
                'option_key' => 'crop-variety',
                'option_category' => 'crop',
                'option_description' => 'Variedades de cultivo autorizadas',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Patrón/pie',
                'option_key' => 'crop-pattern',
                'option_category' => 'crop',
                'option_description' => 'Patrones/pies de cultivo autorizados',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Conducción',
                'option_key' => 'crop-training',
                'option_category' => 'crop',
                'option_description' => 'Conducciones de cultivo disponibles',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Cubierta vegetal',
                'option_key' => 'crop-green',
                'option_category' => 'crop',
                'option_description' => 'El cultivo dispone de cubierta vegetal',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Análisis de suelo',
                'option_key' => 'analysis-soil',
                'option_category' => 'analysis',
                'option_description' => 'Mostrar análisis de suelo (Edafología)',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Análisis de Hoja',
                'option_key' => 'analysis-sheet',
                'option_category' => 'analysis',
                'option_description' => 'Mostrar análisis de hoja',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'option_name' => 'Análisis de agua',
                'option_key' => 'analysis-water',
                'option_category' => 'analysis',
                'option_description' => 'Mostrar análisis de agua',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
        ]);
    }
}
