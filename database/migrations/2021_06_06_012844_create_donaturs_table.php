<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonatursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donaturs', function (Blueprint $table) {
            $table->id('id_donatur');
            $table->string('nama_donatur');
            $table->string('email')->unique();
            $table->char('no_telepon');
            $table->char('jumlah_donasi');
            $table->timestamp('dibuat_tanggal');
            $table->string('status');
        });

        Schema::rename('donaturs', 'donatur');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donaturs');
    }
}
