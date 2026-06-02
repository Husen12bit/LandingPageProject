<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_telepon', 15);
            $table->string('keahlian');
            $table->text('portfolio')->nullable();
            $table->text('deskripsi');
            $table->decimal('harga_per_hari', 10, 2);
            $table->integer('pengalaman_tahun')->default(0);
            $table->float('rating')->default(0);
            $table->enum('status', ['aktif', 'nonaktif', 'verifikasi'])->default('verifikasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancers');
    }
};
