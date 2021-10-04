<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSubCategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('sub_categorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->string('sub_categoria', 45);
            $table->boolean('eliminado')->default(0);
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }
    public function down()
    {
        Schema::dropIfExists('sub_categorias');
    }
}
