<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plots', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('plot_ref', 10)->comment('Internal Reference of the Plot');
            $table->integer('user_id')->nullable()->comment('Sometimes we need to add the user later...');
            $table->integer('client_id')->unsigned()->index();
            $table->integer('city_id')->nullable()->unsigned()->index();
            $table->integer('plant_id')->nullable()->unsigned()->index();
            $table->integer('warehouse_id')->nullable()->unsigned()->index();
            $table->integer('country_id')->default(1)->unsigned()->index();
            $table->integer('region_id')->nullable()->unsigned()->index();
            $table->integer('state_id')->nullable()->unsigned()->index();
            $table->string('plot_name')->nullable();
            $table->decimal('plot_framework_x', 6, 2)->nullable()->comment('Framework planting: crop distance');
            $table->decimal('plot_framework_y', 6, 2)->nullable()->comment('Framework planting: line separation');
            $table->decimal('plot_area', 12, 2)->nullable()->comment('Unit: ha');
            $table->decimal('plot_real_area', 12, 2)->nullable()->comment('Real area base on the plot_area and the plot_percent_cultivated_land. Unit: ha');
            $table->tinyInteger('plot_percent_cultivated_land')->default(100)->comment('Percentage of cultivated land without deciamals');
            $table->string('plot_green_cover', 3)->nullable()->comment('yes or not');
            $table->string('plot_pond', 3)->nullable()->comment('yes or not');
            $table->tinyInteger('plot_road')->nullable()->comment('Typo of road from a config array');
            $table->string('plot_active', 3)->default('yes')->comment('yes or not');
            $table->integer('plot_start_date')->nullable()->comment('Crops planting date');
            $table->decimal('plot_last_production', 12, 2)->nullable()->comment('Plots last production. This is a internal data for PHD');

            $table->integer('crop_id')->nullable()->unsigned()->index();
            $table->integer('crop_variety_id')->nullable()->unsigned()->index();
            $table->integer('crop_variety_type')->nullable()->unsigned()->index()->comment('In the grape case: 0/1 white or red');
            $table->integer('pattern_id')->nullable()->unsigned()->index();
            $table->integer('plot_crop_quantity')->nullable()->comment('The total number of items. Its can be calculated base on the framework and the area');
            $table->integer('plot_crop_training')->nullable()->unsigned();

            $table->string('plot_quality_igp', 3)->default('yes')->comment('yes or not');
            $table->string('plot_quality_dop', 3)->default('yes')->comment('yes or not');

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
        Schema::dropIfExists('plots');
    }
}
