<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateModulosTable extends Migration
{
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->string('modulo', 45);
            $table->boolean('eliminado')->default(0);
        });
    }
    public function down()
    {
        Schema::dropIfExists('modulos');
    }
}
