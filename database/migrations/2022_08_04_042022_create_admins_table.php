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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->default(2);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cell')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('location')->nullable();
            $table->string('dob')->nullable();
            $table->text('bio')->nullable();
            $table->text('photo')->default('avater.png');
            $table->string('adderss')->nullable();
            $table->string('access_token')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('trash')->default(false);
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
        Schema::dropIfExists('admins');
    }
};
