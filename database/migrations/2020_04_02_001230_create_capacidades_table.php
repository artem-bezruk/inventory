<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCapacidadesTable extends Migration
{
    public function up()
    {
        Schema::create('capacidades', function (Blueprint $table) {
            $table->id();
            $table->integer('capacidad');
            $table->unsignedBigInteger('nomenclatura_id');
            $table->boolean('eliminado')->default(0);
            $table->foreign('nomenclatura_id')->references('id')->on('nomenclaturas');
        });
    }
    public function down()
    {
        Schema::dropIfExists('capacidades');
    }
}
