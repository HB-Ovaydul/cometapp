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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('sort_des')->nullable();
            $table->longText('long_des')->nullable();
            $table->string('price')->nullable();
            $table->string('regular_price')->nullable();
            $table->text('photo')->nullable();
            $table->longText('gallery')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('pices')->nullable();
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
        Schema::dropIfExists('products');
    }
};
