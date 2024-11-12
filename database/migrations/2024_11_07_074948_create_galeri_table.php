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
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_galeri');
            $table->string('galeri_seo');
            $table->text('keterangan');
            $table->string('foto');
            $table->string('path');
            $table->unsignedBigInteger('books_id'); // Ubah menjadi 'books_id' dengan satu underscore
            $table->foreign('books_id')
                ->references('id')
                ->on('books') // Pastikan nama tabel adalah 'books', bukan 'buku'
                ->onDelete('cascade');
            $table->timestamps();
        });        
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
