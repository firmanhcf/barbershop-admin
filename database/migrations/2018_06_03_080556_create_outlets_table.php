<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('outlet_id')->unique();
            $table->integer('partner_id')->unsigned();
            $table->integer('partnership_id')->unsigned();
            $table->string('address');
            $table->integer('district')->unsigned();
            $table->integer('regency')->unsigned();
            $table->integer('province')->unsigned();
            $table->string('telephone_number');
            $table->integer('total_seat');
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
        Schema::drop('outlets');
    }
}
