<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('client_id')->unsigned()->index();
            $table->string('plant_ref', 10)->nullable()->comment('Internal Reference of the plant');
            $table->string('plant_name', 150);
            $table->string('plant_company', 150)->nullable();
            $table->string('plant_address', 150)->nullable()->default(NULL);
            $table->string('plant_nif', 50)->nullable()->default(NULL);
            $table->string('plant_city', 100)->nullable()->default(NULL);
            $table->string('plant_state', 100)->nullable()->default(NULL);
            $table->string('plant_region', 100)->nullable()->default(NULL);
            $table->string('plant_country', 100)->nullable()->default(NULL);
            $table->string('plant_zip', 10)->nullable()->default(NULL);
            $table->string('plant_telephone', 20)->nullable()->default(NULL);
            $table->string('plant_contact', 150)->nullable()->default(NULL);
            $table->string('plant_email', 150)->nullable()->default(NULL);
            $table->string('plant_nif_alt', 50)->nullable()->default(NULL);
            $table->string('plant_address_alt', 150)->nullable()->default(NULL);
            $table->string('plant_city_alt', 100)->nullable()->default(NULL);
            $table->string('plant_state_alt', 100)->nullable()->default(NULL);
            $table->string('plant_region_alt', 100)->nullable()->default(NULL);
            $table->string('plant_zip_alt', 10)->nullable()->default(NULL);
            $table->string('plant_contact_alt', 150)->nullable()->default(NULL);
            $table->string('plant_telephone_alt', 20)->nullable()->default(NULL);
            $table->string('plant_email_alt', 150)->nullable()->default(NULL);
            $table->text('plant_observations')->nullable()->default(NULL);
            $table->decimal('plant_lat', 10, 6)->nullable();
            $table->decimal('plant_lng', 10, 6)->nullable();
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
        Schema::dropIfExists('plants');
    }
}
