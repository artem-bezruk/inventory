<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSubClasesTable extends Migration
{
    public function up()
    {
        Schema::create('sub_clases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clase_id');
            $table->string('sub_clase', 45);
            $table->boolean('eliminado')->default(0);
            $table->foreign('clase_id')->references('id')->on('clases');
        });
    }
    public function down()
    {
        Schema::dropIfExists('sub_clases');
    }
}
