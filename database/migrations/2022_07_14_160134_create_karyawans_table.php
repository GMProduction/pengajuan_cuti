<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'karyawans',
            function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id')->unsigned()->nullable(true);
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('nama');
                $table->string('nip');
                $table->string('alamat');
                $table->string('no_hp', '14');
                $table->integer('sisa_cuti');
                $table->text('foto');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}
