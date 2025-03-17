<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\CommonConstants;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->enum('role', [CommonConstants::ROLE_USER, CommonConstants::ROLE_ADMIN])->default(CommonConstants::ROLE_USER)->comment('1: ユーザー, 2: 管理者');
                $table->integer('login_id')
                ->unique()
                ->unsigned()
                ->check('login_id >= 10000 AND login_id <= 99999')
                ->nullable();
                $table->string('password')->nullable();
                $table->string('device_token')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
