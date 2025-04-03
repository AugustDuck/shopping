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
        Schema::create('taggables', function (Blueprint $table) {
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->string('taggable_type'); // Loại thực thể (ví dụ: App\Models\Product)
            $table->unsignedBigInteger('taggable_id'); // ID của thực thể
            $table->timestamps();
        
            // Chỉ mục để tối ưu truy vấn
            $table->index(['taggable_type', 'taggable_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taggables');
    }
};
