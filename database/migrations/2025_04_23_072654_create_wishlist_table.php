<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistTable extends Migration
{
    public function up(): void
    {
        Schema::create('wishlist', function (Blueprint $table) {
            $table->string('kode_wishlist', 255)->primary();
            $table->string('nama_wishlist', 255);
            $table->string('link_olshop', 255)->nullable();
            $table->string('target_beli', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
}
