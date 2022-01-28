<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_buku', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buku_id')->unsigned();
            $table->bigInteger('anggota_id')->unsigned();
            $table->date('tanggal_pinjam')->nullable();
            $table->date('tanggal_pengembalian')->nullable();
            $table->string('status')->default('Menunggu persetujuan');
            $table->integer('jumlah_buku')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('buku_id')->references('id')->on('buku')->onDelete('cascade');
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjam_bukus');
    }
}
