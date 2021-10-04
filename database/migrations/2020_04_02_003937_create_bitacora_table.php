<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBitacoraTable extends Migration
{
    public function up()
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modulo_id');
            $table->integer('item');
            $table->string('accion', 45);
            $table->string('descripcion', 255);
            $table->timestamp('fecha');
            $table->foreign('modulo_id')->references('id')->on('modulos');
        });
    }
    public function down()
    {
        Schema::dropIfExists('bitacora');
    }
}
