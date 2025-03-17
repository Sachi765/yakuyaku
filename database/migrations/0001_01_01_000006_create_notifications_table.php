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
        if (!Schema::hasTable('notifications')) {
        Schema::create('notifications', function (Blueprint $table) {
           
                $table->id();
                $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
                $table->enum('type',['0','1','2','9'])->default('1')->comment('0:受付なし,1: 受付完了, 1: 処方中, 9: 処方完了');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
