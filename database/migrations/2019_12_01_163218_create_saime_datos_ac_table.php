<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaimeDatosAcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saime_datos_ac', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idpersona')->unique();
            $table->char('letra');
            $table->integer('numerocedula');
            $table->string('primernombre');
            $table->string('segundonombre');
            $table->string('primerapellido');
            $table->string('segundoapellido');
            $table->date('fechanacimiento');
            $table->char('sexo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("saime_datos_ac");
    }
}
