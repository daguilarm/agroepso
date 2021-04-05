<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('crop_id')->nullable()->unsigned()->index();
            $table->integer('user_total')->default(0);
            $table->integer('plot_total')->default(0);
            $table->integer('plant_total')->default(0);
            $table->integer('warehouse_total')->default(0);
            $table->integer('inspection_total')->default(0);
            $table->string('client_name', 150);
            $table->string('client_address', 150)->nullable()->default(NULL);
            $table->string('client_nif', 50)->nullable()->default(NULL);
            $table->string('client_city', 100)->nullable()->default(NULL);
            $table->string('client_state', 100)->nullable()->default(NULL);
            $table->string('client_region', 100)->nullable()->default(NULL);
            $table->string('client_country', 100)->nullable()->default(NULL);
            $table->string('client_zip', 10)->nullable()->default(NULL);
            $table->string('client_telephone', 20)->nullable()->default(NULL);
            $table->string('client_contact', 150);
            $table->string('client_email', 150);
            $table->string('client_web')->nullable();
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
        Schema::drop('clients');
    }
}
