<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_clase_id');
            $table->string('categoria', 45);
            $table->boolean('ver_capacidad')->default(0);
            $table->boolean('eliminado')->default(0);
            $table->foreign('sub_clase_id')->references('id')->on('sub_clases');
        });
    }
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
