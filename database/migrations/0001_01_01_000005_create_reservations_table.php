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
        if (!Schema::hasTable('reservations')) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->string('reservation_number', 4)->nullable();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->enum('status',['0','1','2','9'])->default('1')->comment('0:受付なし,1: 受付完了, 1: 処方中, 9: 処方完了');
                $table->datetime('from_time')->nullable();
                $table->datetime('to_time')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
