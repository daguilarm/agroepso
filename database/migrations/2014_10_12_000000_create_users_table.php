<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_ref', 10)->nullable()->comment('Internal Reference of the plant');
            $table->integer('client_id')->unsigned()->index();
            $table->string('active', 3)->default('yes');
            $table->string('name', 150);
            $table->string('deputy_name', 150)->nullable()->default(NULL)->comment('On behalf of...');
            $table->string('email', 150)->unique();
            $table->string('nif', 50)->nullable()->default(NULL);
            $table->string('password');
            $table->string('locale', 3)->default('es');
            $table->ipAddress('agreement', 40)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
