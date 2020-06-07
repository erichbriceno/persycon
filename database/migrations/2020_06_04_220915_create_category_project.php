<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_project', function (Blueprint $table) {
            $table->bigIncrements('id');        
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('category_id');
            $table->decimal('minimum', 8, 2);
            $table->decimal('maximum', 8, 2);
            $table->timestamps();
            $table->softDeletes();

            //References
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_project');
    }
}
