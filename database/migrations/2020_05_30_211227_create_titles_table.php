<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('category');
            $table->decimal('salary', 8, 2);
            $table->unsignedBigInteger('management_id');
            $table->unsignedBigInteger('salary_type_id');
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();

            //References
            $table->foreign('management_id')->references('id')->on('managements');
            $table->foreign('salary_type_id')->references('id')->on('salary_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titles');
    }
}
