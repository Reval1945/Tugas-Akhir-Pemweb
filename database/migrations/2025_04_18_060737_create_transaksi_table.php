<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
        $table->id();
        $table->string('transaksi_id');
        $table->bigInteger('uid');
        $table->varchar('tipe_transaksi');
        $table->integer('status');
        $table->bigInteger('jenis_id');
        $table->timestamps();
        $table->bigInteger('nominal');
        $table->text('catatan');
        $table->string('file');
        $table->integer('id_sumberdana');
        
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
