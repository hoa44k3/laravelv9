<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('email')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user')->after('password'); // Giá trị mặc định là 'user'
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
