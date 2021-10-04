<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateNomenclaturasTable extends Migration
{
    public function up()
    {
        Schema::create('nomenclaturas', function (Blueprint $table) {
            $table->id();
            $table->string('nomenclatura', 45);
            $table->string('abreviatura', 5);
            $table->boolean('eliminado')->default(0);
        });
    }
    public function down()
    {
        Schema::dropIfExists('nomenclaturas');
    }
}
