<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->delete();

        DB::table('modules')->insert([
            [
                'id' => 1,
                'module_name' => 'Agronómico',
                'module_key' => 'agronomics',
                'module_description' => 'Módulo de gestión de agrícola / Cuaderno de campo',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 2,
                'module_name' => 'Trabajadores',
                'module_key' => 'workers',
                'module_description' => 'Módulo de gestión de trabajadores',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 3,
                'module_name' => 'Maquinaria',
                'module_key' => 'machines',
                'module_description' => 'Módulo de gestión de maquinaria y equipos',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 4,
                'module_name' => 'Inspecciones',
                'module_key' => 'inspections',
                'module_description' => 'Módulo de gestión y planificación de inspecciones',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 5,
                'module_name' => 'Parcelas',
                'module_key' => 'plots',
                'module_description' => 'Módulo de gestión de parcelas agrícolas',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 6,
                'module_name' => 'Etiquetas',
                'module_key' => 'labels',
                'module_description' => 'Gestión de etiquetas y sellos de certificación',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 7,
                'module_name' => 'Plantas/Embotellado',
                'module_key' => 'plants',
                'module_description' => 'Gestión de plantas de embotellado',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 8,
                'module_name' => 'Almacenes',
                'module_key' => 'warehouses',
                'module_description' => 'Gestión de almacenes',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 9,
                'module_name' => 'Certificados',
                'module_key' => 'certificates',
                'module_description' => 'Módulo de gestión de certificados',
                'deleted_at' => NULL,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
