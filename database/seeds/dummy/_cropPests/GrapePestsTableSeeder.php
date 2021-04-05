<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model\Install;
use Carbon\Carbon;

class GrapePestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pests')->insert([
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Enfermedad de Petri', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Oidio en la Vid (Uncinula Necator)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Mildiu de la vid (Plasmopara viticola)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Botritis (Botrytis cinerea)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Yesca (Stereum necator)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Eutipiosis o Eutipia (Eutypa lata)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Podredumbre blanca de las raíces (Armillaria mellea y Rosellinia necatrix)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Podredumbre negra o Black-Rot (Guignardia bidwellii)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Negrilla o Mangla', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Tumores o Agallas del cuello (Agrobacterium tumefaciens)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Virosis (virus)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Cochinillas', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Pulgones (Áfidos)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Trips', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Araña roja (Tetranychus urticae)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Nematodos (Meloidogyne, Heterodera, Ditylenchus...)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Pájaros', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Polilla del racimo (Lobesia botrana)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Erinosis de la vid (Colomerus viti, Eriophyes vitis)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Filoxera (Phylloxera vastatrix)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Coquillo o Altica (Haltica ampelphaga)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Cigarrero de la vid (Byctiscus betulae)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Piral de la vid (Sparganothis pilleriana)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Melazo o Cotonet', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Avispas', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Gusanos blancos (Melolontha melolontha L., Melolontha hippocastani L. y Anoxia villosa L.)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Termitas (Calotermes flaviocollis, F.)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Caracoles (Theba pisana)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Excoriosis (Phomopsis viticola Sacc)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Flavescencia dorada (Scaphoideus littoralis Ball)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Roedores', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pest_name' => 'Plaga uva: Conejos', 'created_at' => new DateTime, 'updated_at' => new DateTime]
        ]);
    }
}
