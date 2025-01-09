<?php

use App\Models\Payslip;
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
        Schema::create('payslip_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Payslip::class)->constrained();
            $table->string('gateway');
            $table->integer('amount');
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslip_transactions');
    }
};
