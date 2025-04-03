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
        Schema::create('order_details', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cart_id')->nullable()->constrained()->onDelete('set null'); // Liên kết với giỏ hàng 
            $table->integer('quantity')->default(1);
            $table->decimal('price', 18, 0)->nullable();
            $table->decimal('unit_price', 10, 2); // Giá tại thời điểm thêm vào giỏ
            $table->decimal('subtotal', 10, 2); 
            $table->timestamps();
            $table->primary(['product_id', 'order_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
