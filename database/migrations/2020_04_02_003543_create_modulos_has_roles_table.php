<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateModulosHasRolesTable extends Migration
{
    public function up()
    {
        Schema::create('modulos_has_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modulo_id');
            $table->unsignedBigInteger('rol_id');
            $table->boolean('create')->default(0);
            $table->boolean('read')->default(0);
            $table->boolean('update')->default(0);
            $table->boolean('delete')->default(0);
            $table->foreign('modulo_id')->references('id')->on('modulos');
            $table->foreign('rol_id')->references('id')->on('roles');
        });
    }
    public function down()
    {
        Schema::dropIfExists('modulos_has_roles');
    }
}
