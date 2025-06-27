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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('buyer_id');
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->timestamp('ordered_at')->useCurrent();
        $table->timestamps();

        // Foreign key constraints
        $table->foreign('buyer_id')->references('id')->on('students')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('orders');
}

};
