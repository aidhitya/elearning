<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique();
            $table->bigInteger('nip')->unique();
            $table->string('no_telp')->unique();
            $table->string('jenkel');
            $table->string('agama');
            $table->date('dob');
            $table->text('alamat');
            $table->text('foto');
            $table->string('pendidikan')->nullable();
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
        Schema::dropIfExists('gurus');
    }
}
