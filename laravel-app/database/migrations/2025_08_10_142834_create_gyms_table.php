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
        Schema::create('gyms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ジム名称
            $table->string('prefecture'); // 都道府県
            $table->string('city'); // 市区町村
            $table->string('address'); // 番地
            $table->timestamps();
            
            // ジム名称と住所の組み合わせでユニーク制約
            $table->unique(['name', 'prefecture', 'city', 'address'], 'gym_unique_name_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
};
