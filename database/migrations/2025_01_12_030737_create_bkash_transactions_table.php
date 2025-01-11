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
        Schema::create('bkash_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('paymentID');
            $table->string('bkashURL');
            $table->string('amount');
            $table->string('merchantInvoiceNumber');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkash_transactions');
    }
};
