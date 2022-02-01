<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateAccionesTable extends Migration
{
    public function up()
    {
        Schema::create('acciones', function (Blueprint $table) {
            $table->id();
            $table->string('accion', 45);
            $table->boolean('eliminado')->default(0);
        });
    }
    public function down()
    {
        Schema::dropIfExists('acciones');
    }
}
