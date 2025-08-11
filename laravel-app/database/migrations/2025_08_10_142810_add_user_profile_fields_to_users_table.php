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
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_id')->unique()->after('id'); // システム自動採番のユーザーID
            $table->integer('age')->after('name'); // 年齢
            $table->enum('gender', ['male', 'female', 'other'])->after('age'); // 性別
            $table->boolean('matching_enabled')->default(false)->after('gender'); // マッチング機能の利用可否
            $table->foreignId('gym_id')->nullable()->constrained()->after('matching_enabled'); // ジムID
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['gym_id']);
            $table->dropColumn(['user_id', 'age', 'gender', 'matching_enabled', 'gym_id']);
        });
    }
};
