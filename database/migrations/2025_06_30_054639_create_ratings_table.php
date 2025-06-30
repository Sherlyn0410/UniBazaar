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
    Schema::create('ratings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Link to specific order
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade'); // or 'students' if applicable
        $table->tinyInteger('rating')->comment('1 to 5'); // rating value
        $table->text('review')->nullable(); // optional review
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
