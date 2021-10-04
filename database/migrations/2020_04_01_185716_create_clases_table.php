<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateClasesTable extends Migration
{
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('clases', 45);
            $table->boolean('eliminado')->default(0);
        });
    }
    public function down()
    {
        Schema::dropIfExists('clases');
    }
}
