<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('plot_id')->nullable()->unsigned()->index();
            $table->integer('plant_id')->nullable()->unsigned()->index();
            $table->integer('warehouse_id')->nullable()->unsigned()->index();
            $table->integer('client_id')->unsigned()->index();
            $table->integer('crop_id')->unsigned()->index();
            $table->integer('city_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index()->comment('Is the inspector id');
            $table->integer('associated_id')->unsigned()->index()->comment('Is an alias for user is. Is the owner of the plant, warehouse, plot,... is the person to be inspected');
            $table->date('inspection_date')->nullable();
            $table->integer('inspection_total_time')->nullable()->comment('Inspection total time in minutes');
            $table->date('inspection_planing_date')->nullable()->comment('The planed date for the inspection');
            $table->string('inspection_status', 3)->comment('1 => Pending, 2 => Planing, 3 => Accomplished');
            $table->string('inspection_type', 3)->comment('1 => Product, 2 => plant, 3 => warehouse, 4 => plot');
            $table->string('inspection_result', 3)->nullable()->comment('1 => negative, 2 => unfavorable (Favorable with problems), 3 => favorable');
            $table->text('inspection_data')->nullable()->comment('All the json with all the data inspection');
            $table->text('inspection_observations')->nullable();
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
        Schema::dropIfExists('inspections');
    }
}
