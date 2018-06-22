<?php

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
            $table->string('nik')->unique();
            $table->string('password', 60);
            $table->string('email')->unique();
            $table->boolean('account_status');
            $table->string('name');
            $table->date('birthdate');
            $table->string('religion');
            $table->string('photo');
            $table->string('address');
            $table->string('city');
            $table->string('id_card_number');
            $table->string('id_card_files');
            $table->string('last_education');
            $table->string('last_education_certificate');
            $table->string('department'); // 0-> Admin; 1 -> Bigsmile staff; 2 -> Partner; 3 -> Outlet Admin Staff; 4 -> Capster
            $table->integer('salary');
            $table->integer('outlet_id')->unsigned();
            $table->rememberToken();
            $table->integer('create_by')->unsigned();
            $table->integer('update_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
