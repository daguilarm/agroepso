<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('country_id')->unsigned()->index();
            $table->integer('state_id')->unsigned()->index();
            $table->integer('region_id')->unsigned()->index();
            $table->string('ine_id', 10)->nullable();
            $table->string('catastro', 10)->nullable();
            $table->string('sigpac', 10)->nullable();
            $table->decimal('city_lat', 10, 6)->default(0);
            $table->decimal('city_lng', 10, 6)->default(0);
            $table->string('city_name', 100);
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
        Schema::dropIfExists('cities');
    }
}
