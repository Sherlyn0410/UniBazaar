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
        Schema::create('reports', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('buyer_id');
    $table->unsignedBigInteger('seller_id');
    $table->unsignedBigInteger('order_id');
    $table->text('reason');
    $table->timestamps();

    $table->foreign('buyer_id')->references('id')->on('students')->onDelete('cascade');
    $table->foreign('seller_id')->references('id')->on('students')->onDelete('cascade');
    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
