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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(NULL);
            $table->string('email')->unique()->nullable()->default(NULL);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->default(NULL);
            $table->rememberToken();
            $table->timestamps();
            $table->string('google_id')->nullable()->default(NULL);
            $table->string('phone_number')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
