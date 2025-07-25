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
        $table->foreignId('seller_id')->constrained('students')->onDelete('cascade');
        $table->foreignId('buyer_id')->constrained('students')->onDelete('cascade');
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->tinyInteger('rating'); // 1 to 5
        $table->text('review')->nullable();
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
