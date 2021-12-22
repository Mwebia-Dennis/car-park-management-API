<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('USERS', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->string('email', 300)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 500);
            $table->string('profile_img', 500);
            $table->string('verification_token', 500)->nullable();
            $table->string('role', 20)->default('ADMIN');
            $table->integer('verified')->default(0);
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('USERS');
    }
}
