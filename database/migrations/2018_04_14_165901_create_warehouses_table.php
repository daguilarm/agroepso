<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('client_id')->unsigned()->index();
            $table->integer('plant_id')->unsigned()->index();
            $table->string('warehouse_name', 150);
            $table->string('warehouse_company', 150)->nullable();
            $table->string('warehouse_ref', 10)->nullable()->comment('Internal Reference of the warehouse');
            $table->string('warehouse_address', 150)->nullable()->default(NULL);
            $table->string('warehouse_nif', 50)->nullable()->default(NULL);
            $table->string('warehouse_city', 100)->nullable()->default(NULL);
            $table->string('warehouse_state', 100)->nullable()->default(NULL);
            $table->string('warehouse_region', 100)->nullable()->default(NULL);
            $table->string('warehouse_country', 100)->nullable()->default(NULL);
            $table->string('warehouse_zip', 10)->nullable()->default(NULL);
            $table->string('warehouse_telephone', 20)->nullable()->default(NULL);
            $table->string('warehouse_contact', 150)->nullable()->default(NULL);
            $table->text('warehouse_observations')->nullable()->default(NULL);
            $table->decimal('warehouse_lat', 10, 6)->nullable();
            $table->decimal('warehouse_lng', 10, 6)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
}
