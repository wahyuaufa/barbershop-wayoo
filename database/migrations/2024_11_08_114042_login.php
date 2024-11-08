<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->id(); // Kolom id yang auto increment
            $table->string('user_name')->unique(); // Kolom user_name yang harus unik
            $table->string('password'); // Kolom password
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account'); // Menghapus tabel account jika rollback dilakukan
    }
};
