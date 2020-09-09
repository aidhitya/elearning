<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuridsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('murids', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique();
            $table->integer('nis')->unique();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('no_telp')->unique();
            $table->string('agama');
            $table->string('jenkel');
            $table->date('dob');
            $table->text('alamat');
            $table->text('foto');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('murids');
    }
}
