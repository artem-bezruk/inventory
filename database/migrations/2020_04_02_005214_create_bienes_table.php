<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBienesTable extends Migration
{
    public function up()
    {
        Schema::create('bienes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('sub_categoria_id');
            $table->unsignedBigInteger('capacidad_id')->nullable();
            $table->string('modelo', 50);
            $table->integer('cantidad');
            $table->boolean('eliminado')->default(0);
            $table->timestamp('fecha_registro');
            $table->unsignedBigInteger('usuario_registra');
            $table->timestamp('fecha_modificacion')->nullable();
            $table->unsignedBigInteger('usuario_modifica')->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias');
            $table->foreign('capacidad_id')->references('id')->on('capacidades');
            $table->foreign('usuario_registra')->references('id')->on('users');
            $table->foreign('usuario_modifica')->references('id')->on('users');
        });
    }
    public function down()
    {
        Schema::dropIfExists('bienes');
    }
}
