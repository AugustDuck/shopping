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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_category_id')->constrained()->cascadeOnDelete();
            $table->string('name', 250)->nullable();
            $table->integer('status')->nullable();
            $table->string('image', 250)->nullable();
            $table->decimal('price', 18, 0)->nullable()->default(0);
            $table->decimal('promotion_price', 18, 0)->nullable()->default(0);
            $table->longText('description')->nullable();
            $table->integer('view_count')->nullable();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
