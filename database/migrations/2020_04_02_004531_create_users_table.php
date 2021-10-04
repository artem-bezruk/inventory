<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('cedula')->unique()->nullable();
            $table->unsignedBigInteger('genero_id');
            $table->string('correo', 70);
            $table->unsignedBigInteger('estatus_id');
            $table->unsignedBigInteger('rol_id');
            $table->string('username', 45)->unique();
            $table->string('password', 255);
            $table->timestamp('fecha_registro');
            $table->timestamp('fecha_modificacion')->nullable();
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->foreign('estatus_id')->references('id')->on('estatus');
            $table->foreign('rol_id')->references('id')->on('roles');
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
