<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateEstatusTable extends Migration
{
    public function up()
    {
        Schema::create('estatus', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 45);
            $table->boolean('eliminado')->default(0);
        });
    }
    public function down()
    {
        Schema::dropIfExists('estatus');
    }
}
