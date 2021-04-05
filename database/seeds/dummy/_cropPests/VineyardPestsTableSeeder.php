<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model\Install;
use Carbon\Carbon;

class VineyardPestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pests')->insert([
            ['crop_id' => 1, 'pest_name' => 'Enfermedad de Petri', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Oidio en la Vid (Uncinula Necator)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Mildiu de la vid (Plasmopara viticola)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Botritis (Botrytis cinerea)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Yesca (Stereum necator)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Eutipiosis o Eutipia (Eutypa lata)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Podredumbre blanca de las raíces (Armillaria mellea y Rosellinia necatrix)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Podredumbre negra o Black-Rot (Guignardia bidwellii)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Negrilla o Mangla', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Tumores o Agallas del cuello (Agrobacterium tumefaciens)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Virosis (virus)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Cochinillas', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Pulgones (Áfidos)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Trips', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Araña roja (Tetranychus urticae)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Nematodos (Meloidogyne, Heterodera, Ditylenchus...)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Pájaros', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Polilla del racimo (Lobesia botrana)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Erinosis de la vid (Colomerus viti, Eriophyes vitis)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Filoxera (Phylloxera vastatrix)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Coquillo o Altica (Haltica ampelphaga)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Cigarrero de la vid (Byctiscus betulae)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Piral de la vid (Sparganothis pilleriana)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Melazo o Cotonet', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Avispas', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Gusanos blancos (Melolontha melolontha L., Melolontha hippocastani L. y Anoxia villosa L.)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Termitas (Calotermes flaviocollis, F.)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Caracoles (Theba pisana)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Excoriosis (Phomopsis viticola Sacc)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Flavescencia dorada (Scaphoideus littoralis Ball)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Roedores', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pest_name' => 'Conejos', 'created_at' => new DateTime, 'updated_at' => new DateTime]
        ]);
    }
}
