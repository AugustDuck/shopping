<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->string('status', 20)->default('pending'); // Sửa thành string hoặc enum cho trạng thái
            $table->foreignId('shipping_unit_id')->nullable()->constrained()->onDelete('set null');
            $table->dateTime('expected_delivery_date')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Còn có thể bỏ nullable() nếu cần
            $table->foreignId('discount_id')->nullable()->constrained()->onDelete('set null'); // Chỉ để null khi không có giảm giá
            $table->timestamps(); // Tạo thêm cột created_at và updated_at
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
