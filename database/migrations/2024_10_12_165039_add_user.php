<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm các cột mới
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Xóa các cột nếu rollback
            $table->dropColumn(['phone', 'address', 'birthday', 'description']);
        });
    }
};
