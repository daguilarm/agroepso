<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlotGeolocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plot_geolocations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('plot_id')->unsigned()->index();
            $table->integer('climatic_station_id')->nullable()->unsigned()->index();
            $table->decimal('climatic_station_distance', 12, 2)->nullable();
            $table->decimal('geo_lat', 10, 6)->nullable();
            $table->decimal('geo_lng', 10, 6)->nullable();
            $table->decimal('geo_x', 10, 2)->nullable();
            $table->decimal('geo_y', 10, 2)->nullable();
            $table->string('geo_srs', 20)->nullable();
            $table->string('geo_bbox', 30)->nullable();
            $table->string('geo_sigpac_region', 10)->nullable();
            $table->string('geo_sigpac_city', 10)->nullable();
            $table->string('geo_sigpac_aggregate', 10)->nullable()->default(0);
            $table->string('geo_sigpac_zone', 10)->nullable()->default(0);
            $table->string('geo_sigpac_polygon', 10)->nullable();
            $table->string('geo_sigpac_plot', 10)->nullable();
            $table->string('geo_sigpac_precinct', 10)->nullable();
            $table->text('geo_catastro', 20)->nullable();
            $table->text('geo_catastro_url')->nullable();
            $table->decimal('geo_height', 6, 2)->nullable();
            $table->integer('frame_width')->nullable()->comment('Map tile width');
            $table->integer('frame_height')->nullable()->comment('Map tile height');
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
        Schema::dropIfExists('plot_geolocations');
    }
}
