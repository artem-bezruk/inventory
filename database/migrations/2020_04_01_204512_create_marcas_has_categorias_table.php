<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMarcasHasCategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('marcas_has_categorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('categoria_id');
            $table->boolean('eliminado')->default(0);
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }
    public function down()
    {
        Schema::dropIfExists('marcas_has_categorias');
    }
}
