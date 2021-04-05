<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->date('profile_birthdate')->nullable();
            $table->string('profile_address', 150)->nullable();
            $table->string('profile_city', 100)->nullable();
            $table->string('profile_country', 100)->nullable();
            $table->string('profile_region', 100)->nullable();
            $table->string('profile_state', 100)->nullable();
            $table->string('profile_zip', 20)->nullable();
            $table->string('profile_telephone', 30)->nullable();
            $table->string('profile_url')->nullable();
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
        Schema::drop('profiles');
    }
}
