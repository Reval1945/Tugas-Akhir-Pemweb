<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSumberDanaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sumber_dana', function (Blueprint $table) {
            $table->id(); // sama dengan int(11), auto increment, primary key
            $table->string('sumber'); // varchar(255), not null
            $table->string('logo')->nullable(); // varchar(255), boleh null
            $table->timestamps(); // created_at dan updated_at dengan default current timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_dana');
    }
}
