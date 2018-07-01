<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAssetItemsAddCol2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_items', function($table) {
            $table->integer('unit'); // 1 => Botol, 2 => Dus, 3 => Paket, 4 => Pcs
            $table->integer('economic_age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_items', function($table) {
            $table->dropColumn('unit');
            $table->dropColumn('economic_age');
        });
    }
}
