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
        Schema::create('hasil_esais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            $table->unsignedBigInteger('ujian_id');
            
            $table->unsignedBigInteger('soal_esai_id');

            $table->text('jawaban');

            $table->integer('nilai')->nullable();
            
            $table->timestamps();
            
            $table->foreign('soal_esai_id')->on('soal_esais')->references('id')->onDelete('CASCADE');
            
            $table->foreign('user_id')->on('users')->references('id')->onDelete('CASCADE');
            
            $table->foreign('ujian_id')->on('ujians')->references('id')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_esais');
    }
};
