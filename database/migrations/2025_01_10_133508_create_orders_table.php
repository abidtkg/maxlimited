<?php

use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->decimal('total_product_price');
            $table->decimal('delivery_fee');
            $table->decimal('discount')->default(0);
            $table->decimal('due');
            $table->decimal('payable');
            $table->string('status')->default('pending');
            $table->foreignId('rider_id')->nullable()->constrained('users');
            $table->string('payment_method');
            $table->string('note')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->string('payment_mode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
