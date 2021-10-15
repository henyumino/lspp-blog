<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSepeda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_sepeda', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sepeda');
            $table->string('merk_sepeda');
            $table->integer('jenis_sepeda');
            $table->enum('peruntukan', ['laki-laki', 'perempuan']);
            $table->integer('jumlah_speed');
            $table->dateTime('tanggal_launching', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_sepeda');
    }
}
