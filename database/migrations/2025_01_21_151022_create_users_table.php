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
        Schema::create('users', function (Blueprint $table) {
            $table->id();                       // Khóa chính
            $table->string('name');             // Tên người dùng
            $table->string('email')->unique();  // Email (duy nhất)
            $table->timestamp('email_verified_at')->nullable(); // Thời gian xác minh email
            $table->string('password');         // Mật khẩu (đã mã hóa)
            $table->rememberToken();            // Token để "nhớ" đăng nhập

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
        Schema::dropIfExists('users');
    }
};
