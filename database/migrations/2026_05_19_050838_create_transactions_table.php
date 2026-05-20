<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); // ID transaksi unik
            $table->unsignedBigInteger('project_id'); // ID proyeknya
            $table->string('payment_type')->nullable(); // bank_transfer, gopay, etc
            $table->string('status')->default('pending'); // pending, settlement, expire
            $table->integer('amount');
            $table->json('midtrans_payload')->nullable(); // nyimpen response mentah dari Midtrans
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
