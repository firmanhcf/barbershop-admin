<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTableAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->integer('staff_status'); // 0 => admin, 1 => big smile staff, 2 => capster, 3 => partner
            $table->integer('staff_position'); // 0=> admin, 1=> big smile owner, 2 => Dirut, 3 => Dirop, 4 => Dir adkup, 5 => dir Marketing & sales, 6 => supervisor, 7 => partner, 8 => capster
            $table->integer('staff_unit');
            $table->dropColumn('city');
            $table->dropColumn('total_barber_seat');
            $table->dropColumn('total_reflection_seat');
            $table->dropColumn('total_training_seat');
            $table->integer('province')->unsigned(); 
            $table->integer('regency')->unsigned();
            $table->integer('district')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->string('city');
            $table->integer('total_barber_seat');
            $table->integer('total_reflection_seat');
            $table->integer('total_training_seat');
            $table->dropColumn('staff_status');
            $table->dropColumn('staff_position');
            $table->dropColumn('staff_unit');
            $table->dropColumn('province');
            $table->dropColumn('regency');
            $table->dropColumn('district');
        });
    }
}
