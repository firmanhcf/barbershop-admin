<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOutletBarberAddCol3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outlets', function($table) {
            $table->dropColumn('total_seat');
            $table->integer('total_barber_seat');
            $table->integer('total_reflection_seat');
            $table->integer('total_training_seat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outlets', function($table) {
            $table->dropColumn('total_training_seat');
            $table->dropColumn('total_reflection_seat');
            $table->dropColumn('total_barber_seat');
            $table->integer('total_seat');
        });
    }
}
