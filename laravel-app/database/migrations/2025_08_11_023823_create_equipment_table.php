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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 器具名
            $table->enum('category', ['chest', 'back', 'legs', 'arms', 'shoulders', 'abs', 'cardio', 'other']); // 部位カテゴリ
            $table->text('description')->nullable(); // 器具の説明
            $table->string('youtube_url')->nullable(); // 使い方動画URL
            $table->boolean('is_default')->default(true); // デフォルト器具かどうか
            $table->timestamps();
            
            $table->unique(['name', 'category']); // 同じカテゴリ内での器具名重複防止
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
