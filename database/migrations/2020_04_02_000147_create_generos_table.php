<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateGenerosTable extends Migration
{
    public function up()
    {
        Schema::create('generos', function (Blueprint $table) {
            $table->id();
            $table->string('genero', 45);
            $table->boolean('eliminado')->default(0);
        });
    }
    public function down()
    {
        Schema::dropIfExists('generos');
    }
}
