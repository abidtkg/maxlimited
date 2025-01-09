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
        Schema::create('package_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->max(255);
            $table->string('phone')->max(15);
            $table->string('upozila')->max(255);
            $table->string('union')->max(255);
            $table->string('package')->max(255);
            $table->string('address')->max(2000);
            $table->string('near_bazar')->max(2000);
            $table->string('why_need')->nullable()->max(2000);
            $table->string('dis_provider')->nullable()->max(2000);
            $table->boolean('seen')->default(false);
            $table->boolean('done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_requests');
    }
};
