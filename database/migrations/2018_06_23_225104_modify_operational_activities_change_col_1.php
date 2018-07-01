<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOperationalActivitiesChangeCol1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('operational_activities');
        Schema::create('operational_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outlet_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('price');
            $table->string('eviden');
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
        Schema::drop('operational_activities');
        Schema::create('operational_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outlet_id')->unsigned();
            $table->string('activity');
            $table->integer('price');
            $table->string('eviden');
            $table->integer('create_by')->unsigned();
            $table->integer('update_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
