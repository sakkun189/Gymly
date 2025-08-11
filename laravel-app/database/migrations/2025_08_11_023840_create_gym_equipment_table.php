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
        Schema::create('gym_equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained()->onDelete('cascade'); // ジムID
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade'); // 器具ID
            $table->string('custom_name')->nullable(); // カスタム器具名（自由入力）
            $table->text('notes')->nullable(); // メモ
            $table->foreignId('added_by_user_id')->constrained('users')->onDelete('cascade'); // 追加したユーザー
            $table->timestamps();
            
            $table->unique(['gym_id', 'equipment_id']); // 同じジムに同じ器具は重複登録不可
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_equipment');
    }
};
