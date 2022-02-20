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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('modulo_id')->nullable();
            $table->integer('item')->nullable();
            $table->unsignedBigInteger('accion_id');
            $table->string('ip', 45);
            $table->string('descripcion', 255);
            $table->string('fecha', 45);
            $table->string('hora', 45);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('modulo_id')->references('id')->on('modulos');
            $table->foreign('accion_id')->references('id')->on('acciones');
        });
    }
    public function down()
    {
        Schema::dropIfExists('bitacora');
    }
}
