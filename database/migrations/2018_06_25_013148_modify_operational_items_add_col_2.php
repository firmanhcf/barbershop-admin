<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOperationalItemsAddCol2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operational_items', function($table) {
            $table->integer('purpose'); // 1 => Administrasi, 2 => Langsung, 3 => Marketing, 4 => Operasional, 5 => Umum
            $table->integer('unit'); // 1 => Botol, 2 => Dus, 3 => Paket, 4 => Pcs
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operational_items', function($table) {
            $table->dropColumn('purpose');
            $table->dropColumn('unit');
        });
    }
}
