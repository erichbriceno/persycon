<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddManagementIdToCoordinations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordinations', function (Blueprint $table) {
            $table->unsignedBigInteger('management_id')->after('description');
            $table->foreign('management_id')->references('id')->on('managements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coordinations', function (Blueprint $table) {
            $table->dropForeign(['management_id']);
            $table->dropColumn('management_id');
        });
    }
}
